<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Budget;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BudgetController extends Controller
{
    //
    public function store(Request $request){

        $request->validate([
            'budget_name' => 'required',
            'budget_value' => 'required'
        ]);

        $dates = array();
        $budget_dates = array();

        switch($request->budget_occurs){
            case 'once':
                $date = Carbon::parse($request->budget_starts);
                array_push($budget_dates,$date);
            break;
            case 'weekly': 
                $start = Carbon::parse($request->budget_starts);
                $end = Carbon::parse($request->budget_ends);
                do{
                    array_push($budget_dates,$start->toDateString());
                    $start->addWeek();
                }while($start <= $end);
                
            break;
            case 'fortnightly': 
                $start = Carbon::parse($request->budget_starts);
                $end = Carbon::parse($request->budget_ends);
                do{
                    array_push($budget_dates, $start->toDateString());
                    $start->addWeek(2);
                }while($start <= $end);
            break;
            case 'monthly': 
                $period = CarbonPeriod::create($request->budget_starts, '1 month', $request->budget_ends);
                foreach ($period as $dt) {
                    array_push($budget_dates, $dt->format("Y-m-d"));
                }
            break;
        }

        foreach($budget_dates as $budget_date){
            $budget = Budget::create([
                'account_id' => $request->account_id,
                'name' => $request->budget_name,
                'date' => $budget_date,
                'type' =>  $request->budget_type,
                'value' => $request->budget_value,
                'adj_type' => $request->budget_adjustment_type,
                'adj_value' => $request->budget_adjustment_value
            ]);
        }
        return response()->json(array('success'=>true,'msg'=>'Budget created successfully'));
    }

    public function getVariance(Request $request){
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth();

        
        if($request->date_range_start){
            $dateS = $request->date_range_start;
        }
        if($request->date_range_end){
            $dateE = $request->date_range_end;
        }
        
        $invoices = DB::table('invoices')
                    ->leftJoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
                    ->leftJoin('account', 'invoice_details.account', '=', 'account.ac_id')
                    ->whereBetween('invoice_date',[$dateS, $dateE])
                    ->get();

        $budgets =  DB::table('budget')
                    ->leftJoin('account', 'budget.account_id', '=', 'account.ac_id')
                    ->where('budget.date', '>=', $dateS)
                    ->where('budget.date', '<=', $dateE) 
                    ->where('account.user_id', auth()->user()->id)
                    ->get();

        $accounts = DB::table('account')->where('user_id', auth()->user()->id)->get();
        
        $data['incoming']['total'] = array(
            'budget' => 0,
            'actual' => 0
        );
        $data['outgoing']['total'] = array(
            'budget' => 0,
            'actual' => 0
        );

        foreach($accounts as $account){
            if($account->ac_id == 1){
                $data['incoming']['accounts'][$account->ac_id] = array(
                    'ac_id' => $account->ac_id,
                    'ac_name' => $account->ac_name,
                    'budget' => 0,
                    'actual' => 0
                );
            }else{
                $data['outgoing']['accounts'][$account->ac_id] = array(
                    'ac_id' => $account->ac_id,
                    'ac_name' => $account->ac_name,
                    'budget' => 0,
                    'actual' => 0
                );
            }
        }
        
        foreach($invoices as $details){
            switch($details->ac_id){
                case 0: 
                    //nothing to do
                break;
                case 1:
                    $data['incoming']['accounts'][$details->ac_id]['actual'] += $details->amount;
                    $data['incoming']['total']['actual'] += $details->amount;
                break;

                default:
                    $data['outgoing']['accounts'][$details->ac_id]['actual'] += $details->amount;
                    $data['outgoing']['total']['actual'] += $details->amount;
            }
        }

        foreach($budgets as $details){
            $account = DB::table('account')->where('ac_id', $details->account_id)->first();
            switch($account->ac_group){
                case 0: 
                    //nothing to do
                break;
                case 1:
                    $data['incoming']['accounts'][$details->account_id]['budget'] += $details->value;
                    $data['incoming']['total']['budget'] += $details->value;
                break;

                default:
                    $data['outgoing']['accounts'][$details->account_id]['budget'] += $details->value;
                    $data['outgoing']['total']['budget'] += $details->value;

            }
        }


        return response()->json($data);
        //exit;
        //return view('pages.budget_variance', $data);
    }

    public function variance(){
        $data['date_start'] = Carbon::now()->startOfMonth()->format('m-d-Y');
        $data['date_end']= Carbon::now()->endOfMonth()->format('m-d-Y');

        return view('pages.budget_variance', $data);
    }

    public function getBudget(Request $request){
        $dates = array();
        $budget_dates = array();
        for($i = 3; $i >= 1; $i--){
            $now = Carbon::now();
            array_push($dates, $now->subMonths($i)->endOfMonth()->toDateString());
        }
        array_push($dates, Carbon::now()->endOfMonth()->toDateString());
        for($i = 1; $i <= 24; $i++){
            $now = Carbon::now();
            array_push($dates, $now->addMonths($i)->endOfMonth()->toDateString());
        }

        foreach($dates as $date){
            $budget_dates[$date] = array('date' => Carbon::parse($date)->format('M Y'), 'details' => []);
        }

        $budgets = Budget::where('account_id',$request->ac_id)->get();

        foreach($budgets as $budget){
            $date = Carbon::parse($budget->date);
            array_push($budget_dates[$date->endOfMonth()->toDateString()]['details'],$budget);
        }

        return response()->json($budget_dates);
    }

    public function update(Request $request){
        $updated_ids = array();
        foreach($request->budget as $id=>$budget){
            switch($id){
                case 'new':
                    for($i = 0; $i < count($budget['date']); $i++){
                        $new = Budget::create([
                            'account_id' => $request->account_id,
                            'name' => $request->name,
                            'date' => $budget['date'][$i],
                            'value' => $budget['value'][$i]
                        ]);
    
                        array_push($updated_ids, $new->id);
                    }
                    
                break;
                default: 
                    $update = Budget::find($id);
                    $update->date = $budget['date'];
                    $update->value = $budget['value'];
                    $update->save();
                    if($update){
                        array_push($updated_ids, $id);
                    }
                break;
            }
        }
        
        if(count($updated_ids) > 0){
            Budget::whereNotIn('id', $updated_ids)->delete();
            return response()->json(array('success'=>true,'msg'=>'Budget updated successfully', 'account_id' => $request->account_id));
        }else{
            return response()->json(array('success'=>true,'msg'=>'No changes has been made', 'account_id' => $request->account_id));
        }
        
    }
}
