<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Invoice;
use App\Invdetail;
use App\Setup;
use Auth;
use Response;
use DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;

// use APP\Mail\SendMail;

class ReportController extends Controller
{
	public function index(){
		return view('pages.reports');
	}

	public function customerstatment(){
		$user = Auth::user();

		$customers = Customer::where('user_id', $user->id)->get();
		return view('pages.customer-statements', compact('customers'));
	}

	public function createstatement(Request $request){
		$data = [];
		$user = Auth::user();
		$customer = Customer::where('cust_id' ,$request->customer)->first();
		
		$opening_balance_date = is_null($customer->as_of_date) ? $customer->updated_date : $customer->as_of_date;
		
		$opening_balance_date = Carbon::createFromFormat('Y-m-d', $opening_balance_date);

		$from = Carbon::createFromFormat('Y-m-d', $request->from);
		if ($from->lt($opening_balance_date)) {
			$data['opening_balance'] = 0;
		}else{
				$data['opening_balance'] = $customer->opening_balance;
		}
		$invoices_total = Invoice::where('cust_id', date('Y-m-d', strtotime($request->from)))
									->where('invoice_date', '<=',$request->from)
									->where('user_id', $user->id)
									->sum('final_total');

		$data['opening_balance'] += $invoices_total;

		$payment_invoices = Invoice::join('inv_payment_details', 'inv_payment_details.inv_id', '=', 'invoices.invoice_id')
							->where('invoices.cust_id',$request->customer)
							->where('pay_date','<=', $request->from)
							->where('user_id', $user->id)
							->sum('amount');
		$data['opening_balance'] -= $payment_invoices;
		$data['paid'] = Invoice::join('inv_payment_details', 'inv_payment_details.inv_id', '=', 'invoices.invoice_id')
								->where('invoices.cust_id',$request->customer)
								->where('pay_date','>=', date('Y-m-d', strtotime($request->from)))
								->where('pay_date','<=',  date('Y-m-d', strtotime($request->to)))
								->where('user_id', $user->id)
								->sum('amount');

		$data['invoiced'] = Invoice::where('cust_id', $request->customer)
									->where('invoice_date', '>=', date('Y-m-d', strtotime($request->from)) )
									->where('invoice_date','<=', date('Y-m-d', strtotime($request->to)))
									->where('user_id', $user->id)
									->sum('final_total');

		$data['invoices'] = Invoice::where('cust_id', $request->customer)
							->where('invoice_date', '>=', date('Y-m-d', strtotime($request->from)))
							->where('invoice_date','<=', date('Y-m-d', strtotime($request->to)))
							->where('user_id', $user->id)
							->orderBy('invoice_date', 'ASC')
							->get();

		$data['payments'] = Invoice::join('inv_payment_details', 'inv_payment_details.inv_id', '=', 'invoices.invoice_id')
									->where('invoices.cust_id',$request->customer)
									->where('pay_date','>=', date('Y-m-d', strtotime($request->from)))
									->where('pay_date','<=', date('Y-m-d', strtotime($request->to)))
									->where('user_id', $user->id)
									->orderBy('pay_date', 'ASC')
									->get();

		$data['from_date'] = $request->from;
		$data['to_date'] = $request->to;
		$data['customer'] = $customer;
		$data['company'] = DB::table('company_info')->where('user_id', $user->id)->first();

		return view('pages.statement-template', $data);
		 
	}
}