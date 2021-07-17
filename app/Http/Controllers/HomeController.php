<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Invoice;
use App\Expense;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $e['title'] = 'Home';

        $e['total_inv'] = DB::table('invoices')->where('user_id', auth()->user()->id)->count();
        $e['a_customer'] = DB::table('customers')->where('user_id', $this->get_user_id(auth()->user()->id))->where('active_status', 1)->count();
 
        $e['i_customer'] = DB::table('customers')->where('user_id', $this->get_user_id(auth()->user()->id))->where('active_status', 0)->count();

        $e["invoices"]=$invoices = DB::table('invoices')
                    ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                    ->where('invoices.user_id', $this->get_user_id(auth()->user()->id))
                    ->orderBy('invoice_id', 'DESC')
                    ->limit(4)
                    ->get();
  
        $p_inv =0;

        foreach ($invoices as $inv) {
            $paid = DB::table('inv_payment_details')->where('inv_id', $inv->invoice_id)->sum('amount');

            $due = ($inv->final_total - $paid);

            if ($due == 0){

                $p_inv +=1;

            }
        }

        $e['p_inv'] = $p_inv;

        $inv = DB::table('inv_settings')->first();

        $e['invName'] = $inv->inv_name;
        $e['invName'] = $inv->inv_name;

        $user_id = auth()->user()->id;
        $invoice_over_due = Invoice::where('due_date','<' , date('Y-m-d'))
                                    ->where('user_id', $user_id)
                                    ->where('status', '3')
                                    ->get();
        $invoice_over_due_sum = 0;
        foreach ($invoice_over_due as $key => $invoice) {
           $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            $invoice_over_due_sum += $invoice->final_total - $paid;
        }

        $invoice_due_this_week = Invoice::where('due_date','<=', Carbon::now()->endOfWeek())
            ->where('due_date', '>' , Carbon::now()->startOfWeek())
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $invoice_due_this_week_sum = 0;
        foreach ($invoice_due_this_week as $key => $invoice) {
           $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            $invoice_due_this_week_sum += $invoice->final_total - $paid;
        }

        $invoice_next_week = Invoice::where('due_date','>', Carbon::now()->addDays(7-Carbon::now()->dayOfWeek))
            ->where('due_date', '<=' , Carbon::now()->addDays(14-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $invoice_next_week_sum = 0;
        foreach ($invoice_next_week as $key => $invoice) {
           $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            $invoice_next_week_sum += $invoice->final_total - $paid;
        }

        $invoice_fort_night = Invoice::where('due_date','>', Carbon::now()->addDays(14-Carbon::now()->dayOfWeek))
            ->where('due_date', '<=' , Carbon::now()->addDays(21-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $invoice_fort_night_sum = 0;
        foreach ($invoice_fort_night as $key => $invoice) {
           $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            $invoice_fort_night_sum += $invoice->final_total - $paid;
        }

        $invoice_twenty_first_night = Invoice::where('due_date','>', Carbon::now()->addDays(21-Carbon::now()->dayOfWeek))
            ->where('due_date', '<=' , Carbon::now()->addDays(28-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $invoice_twenty_first_night_sum = 0;
        foreach ($invoice_twenty_first_night as $key => $invoice) {
           $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            $invoice_twenty_first_night_sum += $invoice->final_total - $paid;
        }


        $expense_over_due = Expense::where('due_date','<' , date('Y-m-d'))
                                    ->where('user_id', $user_id)
                                    ->get();

        $expense_over_due_sum = 0;
        foreach ($expense_over_due as $key => $expense) {
           $paid = DB::table('expense_payments')->where('expense_id', $expense->expense_id)->sum('amount');
            $expense_over_due_sum += $expense->final_total - $paid;
        }
        $expense_due_this_week = Expense::where('payment_date','<=', Carbon::now()->endOfWeek())
            ->where('payment_date', '>=' , Carbon::now()->startOfWeek())
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $expense_due_this_week_sum = 0;
        foreach ($expense_due_this_week as $key => $expense) {
           $paid = DB::table('expense_payments')->where('expense_id', $expense->expense_id)->sum('amount');
            $expense_due_this_week_sum += $expense->final_total - $paid;
        }

        $expense_next_week = Expense::where('payment_date','>', Carbon::now()->addDays(7-Carbon::now()->dayOfWeek))
            ->where('payment_date', '<=' , Carbon::now()->addDays(14-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $expense_next_week_sum = 0;
        foreach ($expense_next_week as $key => $expense) {
           $paid = DB::table('expense_payments')->where('expense_id', $expense->expense_id)->sum('amount');
            $expense_next_week_sum += $expense->final_total - $paid;
        }

        $expense_fort_night = Expense::where('payment_date','>', Carbon::now()->addDays(14-Carbon::now()->dayOfWeek))
            ->where('payment_date', '<=' , Carbon::now()->addDays(21-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $expense_fort_night_sum = 0;
        foreach ($expense_fort_night as $key => $expense) {
           $paid = DB::table('expense_payments')->where('expense_id', $expense->expense_id)->sum('amount');
            $expense_fort_night_sum += $expense->final_total - $paid;
        }

        $expense_twenty_first_night = Expense::where('payment_date','>', Carbon::now()->addDays(21-Carbon::now()->dayOfWeek))
            ->where('payment_date', '<=' , Carbon::now()->addDays(28-Carbon::now()->dayOfWeek))
            ->where('user_id', $user_id)
            ->where('status', '3')
            ->get();

        $expense_twenty_first_night_sum = 0;
        foreach ($expense_fort_night as $key => $expense) {
           $paid = DB::table('expense_payments')->where('expense_id', $expense->expense_id)->sum('amount');
            $expense_twenty_first_night_sum += $expense->final_total - $paid;
        }
        
        $e['invoice_over_due'] = $invoice_over_due_sum;
        $e['invoice_due_this_week'] = $invoice_due_this_week_sum;
        $e['invoice_next_week'] = $invoice_next_week_sum;
        $e['invoice_fort_night'] = $invoice_fort_night_sum;
        $e['invoice_twenty_first_night'] = $invoice_twenty_first_night_sum;

        $e['expense_over_due'] = $expense_over_due_sum;
        $e['expense_due_this_week'] = $expense_due_this_week_sum;
        $e['expense_next_week'] = $expense_next_week_sum;
        $e['expense_fort_night'] = $expense_fort_night_sum;

        $e['expense_twenty_first_night'] = $expense_twenty_first_night_sum;

        $e['next_week_date_start'] = Carbon::now()->addDays(7-Carbon::now()->dayOfWeek)->format('d');
        $e['next_week_date_end'] = Carbon::now()->addDays(14-Carbon::now()->dayOfWeek)->format('d');
        $e['next_week_month_start'] = Carbon::now()->addDays(7-Carbon::now()->dayOfWeek)->format('M');
        $e['next_week_month_end'] = Carbon::now()->addDays(14-Carbon::now()->dayOfWeek)->format('M');


        $e['fort_night_date_start'] = Carbon::now()->addDays(15-Carbon::now()->dayOfWeek)->format('d');
        $e['fort_night_date_end'] = Carbon::now()->addDays(21-Carbon::now()->dayOfWeek)->format('d');

        $e['fort_night_month_start'] = Carbon::now()->addDays(15-Carbon::now()->dayOfWeek)->format('M');
        $e['fort_night_month_end'] = Carbon::now()->addDays(21-Carbon::now()->dayOfWeek)->format('M');

        $e['twenty_first_day_date_start'] = Carbon::now()->addDays(22-Carbon::now()->dayOfWeek)->format('d');
        $e['twenty_first_day_date_end'] = Carbon::now()->addDays(28-Carbon::now()->dayOfWeek)->format('d');

        $e['twenty_first_day_month_start'] = Carbon::now()->addDays(22-Carbon::now()->dayOfWeek)->format('M');
        $e['twenty_first_day_month_end'] = Carbon::now()->addDays(28-Carbon::now()->dayOfWeek)->format('M');
        $e['months'] = [];
        for ($i=1; $i <= 12 ; $i++) { 
            array_push($e['months'], Carbon::now()->addMonth($i)->format('M'));
        }

        $yearly_invoices = Invoice::where('user_id', $user_id)
                                    ->where('invoice_date','<=', Carbon::now())
                                    ->where('invoice_date', '>=' , Carbon::now()->addMonths(-12))
                                    ->where('status', '!=', 1)
                                    ->orderBy('invoice_date', 'DESC')
                                    ->select('invoices.final_total' ,DB::raw("DATE_FORMAT(invoice_date, '%Y-%m') as invoice_month"))
                                    ->get();
        $monthly_invoices = [];

        foreach ($yearly_invoices as $key => $value) {
            // -> as it return std object
            $monthly_invoices[$value->invoice_month][] = $value;
        }

        $monthly_invoices_dues = [];
        $keys = array_keys($monthly_invoices);
        $counter = 0; 

        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->addMonths(-$i)->format('Y-m');
            $monthly_invoices_total = 0;
            if (isset($keys[$counter]) and $date == $keys[$counter]) {

                foreach ($monthly_invoices[$keys[$counter]] as $month => $invoice) {
                    $monthly_invoices_total += $invoice->final_total;
                }
                array_push($monthly_invoices_dues, $monthly_invoices_total);
                $counter++;
            }else{
                array_push($monthly_invoices_dues, $monthly_invoices_total);
            }
        }
        $yearly_expenses = Expense::where('user_id', $user_id)
                                    ->where('payment_date','<=', Carbon::now())
                                    ->where('payment_date', '>=' , Carbon::now()->addMonths(-12))
                                    ->orderBy('payment_date', 'DESC')
                                    ->where('status', '!=', 1)
                                    ->select('final_total' ,DB::raw("DATE_FORMAT(payment_date, '%Y-%m') as 
                                        expense_month"))
                                    ->get();
        $monthly_expenses = [];
            

        foreach ($yearly_expenses as $key => $value) {
            // -> as it return std object
            $monthly_expenses[$value->expense_month][] = $value;
        }
        $monthly_expense_dues = []; 

        $keys = array_keys($monthly_expenses);
        $counter = 0;

        for ($i = 0; $i <= 11; $i++) {
            $date = Carbon::now()->addMonths(-$i)->format('Y-m');
            $month_expense_total = 0;

            if (isset($keys[$counter]) and $date == $keys[$counter]) {

                foreach ($monthly_expenses[$keys[$counter]] as $month => $expense) {
                    $month_expense_total += $expense->final_total;
                }
                array_push($monthly_expense_dues, $month_expense_total);
                $counter++;
            }else{
                array_push($monthly_expense_dues, $month_expense_total);
            }
        }

        $e['monthly_expenses_dues'] = array_reverse($monthly_expense_dues);
        $e['monthly_invoices_dues'] = array_reverse($monthly_invoices_dues);
        
        
        //hina
        $role= Role::findByName('Employee');
        auth()->user()->assignRole($role);
        return view('pages.new.dashboard', $e)->with('role');
        // return view('master');
    }


    //new template

    public function newIndex()
    {

        $e['title'] = 'Home';

        $e['total_inv'] = DB::table('invoices')->where('user_id', $this->get_user_id(auth()->user()->id))->count();
        $e['a_customer'] = DB::table('customers')->where('user_id', $this->get_user_id(auth()->user()->id))->where('active_status', 1)->count();
        $e['i_customer'] = DB::table('customers')->where('user_id', $this->get_user_id(auth()->user()->id))->where('active_status', 0)->take(4)->count();

        $e["invoices"]=$invoices = DB::table('invoices')
                     ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                     ->where('invoices.user_id', $this->get_user_id(auth()->user()->id))
                     ->orderBy('invoice_id', 'DESC')
                     ->limit(4)
                     ->get();

        $p_inv =0;

        foreach ($invoices as $inv) {
            $paid = DB::table('inv_payment_details')->where('inv_id', $inv->invoice_id)->sum('amount');

            $due = ($inv->final_total - $paid);

            if ($due == 0){

                $p_inv +=1;

            }
        }

        $e['p_inv'] = $p_inv;

        $inv = DB::table('inv_settings')->first();

        $e['invName'] = $inv->inv_name;
        $e['invName'] = $inv->inv_name;



        // return view('pages.dashboard', $e);
        return view('pages.new.dashboard', $e);
        // return view('master');
    }

    public static function invoice_statistics ($current_date)
    {
        $u_id = DB::table('users')->where('id', auth()->user()->id)->first();
        $user_id = $u_id->id;

        $result = DB::table('invoices')
                ->where('user_id', $user_id)
                ->where('invoice_date', 'like', '%' . $current_date . '%')
                ->count();

        return $result; 
    }

    public static function check_inv_statistics ($status)
    {
        $u_id = DB::table('users')->where('id', auth()->user()->id)->first();
        $user_id = $u_id->id;

        $result = DB::table('invoices')
                ->where('user_id', $user_id)
                ->where('status', $status)
                ->count();

        return $result; 
    }

    public static function inv_awaiting_statistics ($current_date, $status)
    {
        $u_id = DB::table('users')->where('id', auth()->user()->id)->first();
        $user_id = $u_id->id;

        $result = DB::table('invoices')
                ->where('user_id', $user_id)
                ->where('status', $status)
                ->where('invoice_date', 'like', '%' . $current_date . '%')
                ->count();

        return $result; 
    }



    private function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }
}
