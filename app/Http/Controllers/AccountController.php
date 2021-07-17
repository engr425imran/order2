<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\Account;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AccountController extends Controller
{
    public function getAccount ()
    {
        
        $taxs = DB::table('tax')->get();

        $accounts = DB::table('account')
                    ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
                    ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                    ->where('account.user_id', auth()->user()->id)
                    ->get();
        $data = array();

        $data['ledger_info'] = DB::table('invoice_details')
                            ->leftJoin('account', 'invoice_details.account', '=', 'account.ac_id')
                            ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
                            ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                            ->get();
        return view('pages.account', compact('accounts', 'taxs'), $data);
    }

    public function saveAccount (Request $request)
    {

        $data = array();

        $data['ac_name'] = $request->ac_name;
        $data['ac_number'] = $request->ac_number;
        $data['ac_type'] = $at = $request->ac_type;
        $data['tax_account'] = $request->tax_account;
        $data['description'] = $request->description;

        $e = DB::table('account_type')->where('type_id', $at)->first();

        $data['ac_group'] = $e->type_group;

        $data['created_by'] = auth()->user()->id;

        DB::table('account')->insert($data);

        session()->flash('success', 'Account Information Saved Successfully!');

        return redirect('/cubebooks/get-account');
    }

    public function getAccInfo(Request $request){
        $account = Account::with('budgets')->where('ac_id', $request->ac_id)->first();
        $budgets = $account->budgets;
        $bscenario = array();
        foreach($budgets as $budget){
            switch($budget->occurs){
                case 'once':
                    array_push($bscenario,$budget);
                break;
                case 'weekly': 
                    $start = Carbon::parse($budget->starts);
                    $end = Carbon::parse($budget->ends);
                    do{
                        array_push($bscenario,array(
                            'id' => $budget->id,
                            'account_id' => $budget->account_id,
                            'name' => $budget->name,
                            'occurs' => $budget->occurs,
                            'starts' => $start->toDateString(),
                            'ends'  => $budget->ends,
                            'value' => $budget->value,
                            'adj_type' => $budget->adj_type,
                            'adj_value' => $budget->adj_value
                        ));

                        $start->addWeek();
                        
                    }while($start <= $end);

                break;
                case 'fortnightly': 
                    $start = Carbon::parse($budget->starts);
                    $end = Carbon::parse($budget->ends);
                    do{
                        array_push($bscenario,array(
                            'id' => $budget->id,
                            'account_id' => $budget->account_id,
                            'name' => $budget->name,
                            'occurs' => $budget->occurs,
                            'starts' => $start->toDateString(),
                            'ends'  => $budget->ends,
                            'value' => $budget->value,
                            'adj_type' => $budget->adj_type,
                            'adj_value' => $budget->adj_value
                        ));

                        $start->addWeek(2);
                        
                    }while($start <= $end);
                break;
                case 'monthly': 
                    $period = CarbonPeriod::create($budget->starts, '1 month', $budget->ends);
                    foreach ($period as $dt) {
                        array_push($bscenario,array(
                            'id' => $budget->id,
                            'account_id' => $budget->account_id,
                            'name' => $budget->name,
                            'occurs' => $budget->occurs,
                            'starts' => $dt->format("Y-m-d") ,
                            'ends'  => $budget->ends,
                            'value' => $budget->value,
                            'adj_type' => $budget->adj_type,
                            'adj_value' => $budget->adj_value
                        ));
                    }
                break;
            }
        }
        $account->budgets_scenario = $bscenario;
        return response()->json($account);
    }
    public function catchAccinfo (Request $request)
    {
        $e = $request->ac_id;

        $acc_info = DB::table('account')
                    ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
                    ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                    ->where('account.ac_id', $e)
                    ->first();
        

        $agt_1 = $this->get_acgroup(1, $acc_info->ac_type);
        $agt_2 = $this->get_acgroup(2, $acc_info->ac_type);
        $agt_3 = $this->get_acgroup(3, $acc_info->ac_type);
        $agt_4 = $this->get_acgroup(4, $acc_info->ac_type);
        $agt_5 = $this->get_acgroup(5, $acc_info->ac_type);

        $acc_gt_1 ='';

        foreach ($agt_1 as $g) {
            $acc_gt_1 .='<option value="'.$g->type_id.'">'.$g->type_name.'</option>';
        }

        $acc_gt_2 ='';

        foreach ($agt_2 as $g) {
            $acc_gt_2 .='<option value="'.$g->type_id.'">'.$g->type_name.'</option>';
        }

        $acc_gt_3 ='';

        foreach ($agt_3 as $g) {
            $acc_gt_3 .='<option value="'.$g->type_id.'">'.$g->type_name.'</option>';
        }

        $acc_gt_4 ='';

        foreach ($agt_4 as $g) {
            $acc_gt_4 .='<option value="'.$g->type_id.'">'.$g->type_name.'</option>';
        }

        $acc_gt_5 ='';

        foreach ($agt_5 as $g) {
            $acc_gt_5 .='<option value="'.$g->type_id.'">'.$g->type_name.'</option>';
        }

        $ren_tax ='<option value="'.$acc_info->tax_id.'" selected>'.$acc_info->tax_name . ' (' . $acc_info->tax_amount . ' % )'.'</option>';

        $taxs = DB::table('tax')->where('tax_id', '!=', $acc_info->tax_id)->get();

        foreach ($taxs as $t) {

            $ren_tax .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
        }

        $rendata = '
            <input type="hidden" name="account_id" class="account_id" value="'.$acc_info->ac_id.'">
           

            <div class="form-group">
                <label for="name">Account Number :</label>
                <p><sup>A unique code/number for this account</sup></p>
                <input type="text" class="form-control form-control-sm ac_number_update" id="name" name="ac_number" value="'.$acc_info->ac_number.'" required>
                <span class="emsg hidden text-danger">Please Try another number</span>
            </div>

            <div class="form-group">
                <label for="name">Account Name :</label>
                <p><sup>A short title for this account (limited to 150 characters)</sup></p>

                <input type="text" class="form-control form-control-sm" id="name" name="ac_name" value="'.$acc_info->ac_name.'" required>
            </div>

            
            <div class="form-group">
                <label for="ac_type">Account Type :</label>
                <br>

                <select class="form-control form-control-sm" name="ac_type" id="ac_type" style="width: 100%">

                    <option value="'.$acc_info->type_id.'">'.$acc_info->type_name.'</option>

                    <optgroup label="Income">
                        '.$acc_gt_1.'
                    </optgroup>

                    <optgroup label="Equity">
                        '.$acc_gt_2.'
                    </optgroup>

                    <optgroup label="Expense">
                        '.$acc_gt_3.'
                    </optgroup>

                    <optgroup label="Assets">
                        '.$acc_gt_4.'
                    </optgroup>

                    <optgroup label="Liability">
                        '.$acc_gt_5.'
                    </optgroup>

                </select>
                
            </div>

            <div class="form-group">
                <label for="tax_account">Tax :</label>
                <br>

                <select class="form-control form-control-sm" name="tax_account" id="tax_account" style="width: 100%">
                    '.$ren_tax.'
                    
                </select>
                
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <p><sup>A description of how this account should be used</sup></p>
                <textarea name="description" id="description"  rows="3" class="form-control form-control-sm">'.$acc_info->description.'</textarea>
            </div>
        ';

        echo $rendata;
    }


    public function catchAcNumber (Request $request)
    {
        $e = $request->val;

        $account = DB::table('account')->where('ac_number',  $e)->exists();

        $ren = '';

        if ($account) {

            $ren = '1';
        } else {
            $ren = '2';
        }

        echo $ren;
    }

    public function catchAcNumberup (Request $request)
    {
        $e = $request->val;
        $account_id = $request->account_id;

        $account = DB::table('account')
                ->where('ac_number', $e)
                ->where('ac_id', '!=', $account_id)
                ->exists();

        $ren = '';

        if ($account) {

            $ren = '1';
        } else {
            $ren = '2';
        }

        echo $ren;
    }

    public function updateAcc (Request $request)
    {

        $ac_id = $request->account_id;

        $data = array();

        $data['ac_name'] = $request->ac_name;
        $data['ac_number'] = $request->ac_number;
        $data['ac_type'] = $at = $request->ac_type;
        $data['tax_account'] = $request->tax_account;
        $data['description'] = $request->description;

        $e = DB::table('account_type')->where('type_id', $at)->first();

        $data['ac_group'] = $e->type_group;

        $data['updated_by'] = auth()->user()->id;

        DB::table('account')->where('ac_id', $ac_id)->update($data);

        session()->flash('success', 'Account Information Update Successfully!');

        return redirect('/cubebooks/get-account');
    }

    public function generalLedger ()
    {
        $data = array();

        $data['ledger_info'] = DB::table('invoice_details')
                            ->leftJoin('account', 'invoice_details.account', '=', 'account.ac_id')
                            ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
                            ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                            ->get();

        $data['accounts'] = DB::table('account')->get();

        return view('pages.general_ledger', $data);
    }


    public function searchGeneralLedger (Request $request)
    {
        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $accounts = DB::table('account')->get();

        $ren_data = '';

        $credit = 0;
        $c_total = 0;

        $pyament_acc = 0;
        $py_ac = 0;

        $receivable_ac_c = 0;
        $receivable_ac_ct = 0;

        $reAcPaySum =0;

        $fc_total =0;
        $fd_total =0;

        foreach ($accounts as $a1) {

            $receivable_ac_c = DB::table('invoices')
            ->leftJoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
            ->where('invoices.status', 3)
            ->where('invoice_details.account', $a1->ac_id)
            ->whereBetween('invoice_details.created_date', [$start_date, $end_date])
            ->sum('amount');

            $reAcPay = DB::table('invoices')
            ->leftJoin('inv_payment_details', 'invoices.invoice_id', '=', 'inv_payment_details.inv_id')
            ->where('invoices.status', 3)
            ->whereBetween('inv_payment_details.created_date', [$start_date, $end_date])
            ->sum('inv_payment_details.amount');

            $receivable_ac_ct +=$receivable_ac_c;

            $reAcPaySum += $reAcPay;

            $debit_reAc = ($receivable_ac_ct - $reAcPay);

        }

        if ($receivable_ac_ct > 0) {

            $ren_data .='
                <tr>
                    <td class="text-primary">Accounts Receivable (610)</td>
                    <td class="text-primary text-right">'.$receivable_ac_ct.'</td>
                    <td class="text-primary text-right">'.$reAcPay.'</td>
                    <td class="text-primary text-right">'.$debit_reAc.'</td>
                </tr>
            ';

        }

        foreach ($accounts as $a) {

            $credit = DB::table('invoices')
            ->leftJoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
            ->where('invoices.user_id', auth()->user()->id)
            ->where('invoices.status', 3)
            ->where('invoice_details.account', $a->ac_id)
            ->whereBetween('invoice_details.created_date', [$start_date, $end_date])
            ->sum('amount');
            
            $pyament_acc = DB::table('invoices')
            ->leftJoin('inv_payment_details', 'invoices.invoice_id', '=', 'inv_payment_details.inv_id')
            ->where('invoices.user_id', auth()->user()->id)
            ->where('invoices.status', 3)
            ->where('inv_payment_details.account_id', $a->ac_id)
            ->whereBetween('inv_payment_details.created_date', [$start_date, $end_date])
            ->sum('amount');

            $py_ac += $pyament_acc;
                                            
            $c_total +=$credit;

            $fc_total =($reAcPay + $c_total);

            $fd_total =($py_ac + $receivable_ac_ct);

            if ($credit > 0) {

                $ren_data .= '
                    <tr>
                        <td class="text-primary">'. $a->ac_name.' ('. $a->ac_number.' )'.'</td>
                        <td class="text-primary text-right">0</td>
                        <td class="text-primary text-right">'.$credit.'</td>
                        <td class="text-primary text-right">'.$credit.'</td>
                    </tr>
                ';
            }

            if ($pyament_acc > 0) {

                $ren_data .='
                    <tr>
                        <td class="text-primary">'.$a->ac_name.' ('. $a->ac_number.' )</td>
                        <td class="text-primary text-right">'.$pyament_acc.'</td>
                        <td class="text-primary text-right">0</td>
                        <td class="text-primary text-right">'.$pyament_acc.'</td>
                    </tr>
                ';
            }
        }

        $ren_data .='
            <tr class="b_color">
                <td><b>Total</b></td>
                <td class="text-right"><b>'.$fd_total.'</b></td>
                <td class="text-right"><b>'.$fc_total.'</b></td>
                <td class="text-right"><b></b></td>
            </tr>
        ';

        if ($ren_data == "") {
			echo 1;
        } else {
            echo $ren_data;
        }
    }

    public static function get_acgroup ($id, $not_this_id)
    {
        $e = DB::table('account_type')
            ->where('type_group', $id)
            ->where('type_id', '!=', $not_this_id)
            ->get();

        return $e;
    }

    public static function get_acgrouptype ($id)
    {
        $e = DB::table('account')
            ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
            ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
            ->where('account.ac_group', $id)
            ->get();

        return $e;
    }

    public static function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }
}
