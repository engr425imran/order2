<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use App\Customer;
use App\Supplier;
use App\Product;
use App\Invoice;
use App\Invdetail;
use App\Setup;
use Auth;
use Response;
use DB;

class ExpenseController extends Controller
{
    public function manageExpense() 
    {
        $data = array();
        $data["title"] = "Expense Management";
        // $data["customers"] = Customer::get();
        // $data["products"] = Product::get();
        // $data["setups"] = Setup::find(1);

        $data['inv'] = DB::table('inv_settings')->first();

        $data["expenses"] = DB::table('expenses')
                            ->leftJoin('suppliers', 'expenses.supp_id', '=', 'suppliers.id')
                            ->where('expenses.user_id', $this->get_user_id(auth()->user()->id))
                            ->get();

        return view('pages.expenses', $data);
    }

    public function addExpense ()
    {

        
        $e['accounts'] = DB::table('account')->get();
        $e['tax_rates'] = DB::table('tax')->get();

        $e['suppliers'] = DB::table('suppliers')
            ->where('active_status', 1)
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->get();

        $e['products'] = DB::table('products')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->get();
        
        $e["iaccount"] = DB::table('account')->where('ac_type', 10)->first();
        $e["taxs"] = DB::table('tax')->get();



        $last_inv = DB::table('invoices')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->orderBy('invoice_id', 'DESC')
                    ->first();

        $inv = DB::table('inv_settings')
                ->leftJoin('users', 'inv_settings.updated_by', '=', 'users.id')
                ->where('inv_settings.user_id', $this->get_user_id(auth()->user()->id))
                ->first();

        

        if (isset($inv)) {

            $e['inv'] = $inv;

            if (isset($last_inv)) {
    
                if (is_numeric($last_inv->invoice_code)) {

                    if ($inv->inv_code > $last_inv->invoice_code) {
                        
                        $last_number = $inv->inv_code;

                    } else {
                        $last_number = $last_inv->invoice_code+1;
                    }
                }
            } else {

                if (isset($inv)) {
                    if ($inv->inv_code > 0) {
                        $last_number = $inv->inv_code;
                    } else {
                        $last_number = 1;
                    }
                    
                } else {
                    $last_number = 1;
                }
            }

            $e['last_number'] = 1;

        } else {
            $e['inv'] = '';
            $e['last_number'] = 1;
        }

        return view('pages.addExpense', $e);
    }

    public function catchProduct (Request $request)
    {
        $e = $request->val;

        if ( $e > 0 ){

            $data = DB::table('products')->where('product_id', $e)->first();

            echo $data->p_description;
        } else {
            echo '';
        }
    }

    public function productRate (Request $request)
    {
        $e = $request->val;

        if ( $e > 0 ){

            $data = DB::table('products')->where('product_id', $e)->first();

            echo $data->p_unit_price;
        } else {
            echo '';
        }
    }

    public function productAcc (Request $request)
    {
        $e = $request->val;
        $data = DB::table('products')->where('product_id', $e)->first();
        if ( $data->p_account > 0){

            $sell_acc = DB::table('account')->where('ac_id', $data->p_account)->first();

            $ren_acc_s_1 = $ren_acc_s_2 = $ren_acc_s_3 = $ren_acc_s_4 = $ren_acc_s_5 ='';

            $ac_type_s_1 = $this->get_acgrouptype_edit(1, $sell_acc->ac_id);
            $ac_type_s_2 = $this->get_acgrouptype_edit(2, $sell_acc->ac_id);
            $ac_type_s_3 = $this->get_acgrouptype_edit(3, $sell_acc->ac_id);
            $ac_type_s_4 = $this->get_acgrouptype_edit(4, $sell_acc->ac_id);
            $ac_type_s_5 = $this->get_acgrouptype_edit(5, $sell_acc->ac_id);

            foreach ($ac_type_s_1 as $a) {

                $ren_acc_s_1 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

            foreach ($ac_type_s_2 as $a) {

                $ren_acc_s_2 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

            foreach ($ac_type_s_3 as $a) {

                $ren_acc_s_3 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

            foreach ($ac_type_s_4 as $a) {

                $ren_acc_s_4 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

            foreach ($ac_type_s_5 as $a) {

                $ren_acc_s_5 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

            $ren_data ='<option value="'.$sell_acc->ac_id.'">'.$sell_acc->ac_number.' - '.$sell_acc->ac_name.'</option>';
            $ren_data .='
                <option value="addAcount" class="add_more">&#43; Add Account</option>
                <optgroup label="Income">
                    '.$ren_acc_s_1.'
                </optgroup>
                <optgroup label="Equity">
                    '.$ren_acc_s_2.'
                </optgroup>
                <optgroup label="Expense">
                    '.$ren_acc_s_3.'
                </optgroup>
                <optgroup label="Assets">
                    '.$ren_acc_s_4.'
                </optgroup>
                <optgroup label="Liability">
                    '.$ren_acc_s_5.'
                </optgroup>
            ';

            echo $ren_data;
        } else {
            echo '';
        }
    }

    public function productTax (Request $request)
    {
        $e = $request->val;
        $data = DB::table('products')->where('product_id', $e)->first();

        if ( $data->s_tax_rate > 0 ){

            $tax= DB::table('tax')->where('tax_id', $data->s_tax_rate)->first();

            $ren_tax ='<option value="'.$tax->tax_amount.'__'.$tax->tax_id.'">'.$tax->tax_name.' ('.$tax->tax_amount.' %)</option>';
            $ren_tax .='<option value="addNewTax" class="add_more">&#43; Add New Tax</option>';

            $all = DB::table('tax')->where('tax_id', '!=',$tax->tax_id)->get();

            foreach ($all as $t) {
                $ren_tax .='<option value="'.$t->tax_amount.'__'.$t->tax_id.'">'.$t->tax_name.' ('.$t->tax_amount.' %)</option>';
            }

            echo $ren_tax;
            
        } else {
            echo '';
        }
    }

    public function productTaxamount (Request $request)
    {
        $e = $request->val;
        $data = DB::table('products')->where('product_id', $e)->first();

        if ( $data->s_tax_rate > 0 ){

            $tax= DB::table('tax')->where('tax_id', $data->s_tax_rate)->first();

            echo $tax->tax_amount;
        } else {
            echo '';
        }
    }

    public function catchAcTax (Request $request)
    {
        $e = $request->val;
        
        $ren_data = '<option value="0" disabled selected></option>';
        $ren_data .='<option value="addNewTax" class="add_more">&#43; Add New Tax</option>';

        if ($e > 0) {

            $data = DB::table('account')
                ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                ->where('ac_id', $e)->first();

            

            $ren_data .='<option value="'.$data->tax_amount.'__'.$data->tax_id.'" selected>'.$data->tax_name . ' (' . $data->tax_amount . ' % )'.'</option>';

            $taxs = DB::table('tax')->where('tax_id', '!=', $data->tax_id)->get();

            foreach ($taxs as $t) {

                $ren_data .='<option value="'.$t->tax_amount.'__'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }

            echo $ren_data."___".$data->tax_amount;

            // echo $e;

        } else {

            $taxs = DB::table('tax')->get();

            foreach ($taxs as $t) {

                $ren_data .='<option value="'.$t->tax_amount.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }

            echo $ren_data;
        }
    }

    public function catchOnlytax (Request $request)
    {
        $e = $request->val;

        $data = DB::table('account')
                ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                ->where('ac_id', $e)->first();

        echo $data->tax_amount;
    }

    public function catchSupplier (Request $request)
    {
        $e = $request->val;

        $result = DB::table('suppliers')->where('id', $e)->first();

        $date = date('Y-m-d');
        $d ='';

        $ren_data = '';

        $trems = '';
        if ($result->terms == 1) {
            $trems .='
                <option value="1">Due on Receipt</option>
                <option value="2">Net 15</option>
                <option value="3">Net 30</option>
                <option value="4">Net 60</option>
            ';
        } else if ($result->terms == 2) {

            $trems .='
                <option value="2">Net 15</option>
                <option value="1">Due on Receipt</option>
                <option value="3">Net 30</option>
                <option value="4">Net 60</option>
            ';
        } else if ($result->terms == 3) {
            $trems .='
                <option value="3">Net 30</option>
                <option value="1">Due on Receipt</option>
                <option value="2">Net 15</option>
                <option value="4">Net 60</option>
            ';
        } else if ($result->terms == 4) {
            $trems .='
                <option value="4">Net 60</option>
                <option value="1">Due on Receipt</option>
                <option value="2">Net 15</option>
                <option value="3">Net 30</option>
            ';
        }
        $ren_data ='
            <div class="col-md-4 pull-left">
                                        
                <div class="form-group">
                    <label>Terms</label>
                    <select name="terms" class="form-control form-control-sm catch_terms">
                        '. $trems.'
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="'.$result->email.'" readonly>
                </div>
            </div>

            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address" class="form-control form-control-sm p-1" rows="3" readonly>'.$result->b_street.' '.$result->b_city. ' '.$result->b_postal.' '.$result->b_country.'</textarea>
                </div>
            </div>
        ';
        echo $ren_data;
    }

    public function customerInfodue (Request $request)
    {
        $e = $request->val;
        $cd = $request->cd;

        $result = DB::table('customers')->where('cust_id', $e)->first();

        $date = date('Y-m-d');
        $d ='';
        
        if ($result->terms == 1) {
            $d .= date('Y-m-d', strtotime($cd. ' + 1 days'));
        } else if ($result->terms == 2) {
            $d .= date('Y-m-d', strtotime($cd. ' + 15 days'));
        } else if ($result->terms == 3) {
            $d .= date('Y-m-d', strtotime($cd. ' + 30 days'));
        } else if ($result->terms == 4) {
            $d .= date('Y-m-d', strtotime($cd. ' + 60 days'));
        }
        
        echo $d;
    }

    public function customerterms (Request $request)
    {
        $e = $request->val;

        $cd =$request->cd;

        $d ='';

        if ($e == 1) {

            $d .= date('Y-m-d', strtotime($cd. ' + 1 days'));
        }
        if ($e == 2) {
            $d .= date('Y-m-d', strtotime($cd. ' + 15 days'));
        }
        if ($e == 3) {
            $d .= date('Y-m-d', strtotime($cd. ' + 30 days'));
        } 
        if ($e == 4) {
            $d .= date('Y-m-d', strtotime($cd. ' + 60 days'));
        }

        echo $d;
    }


    public function changeInvDate (Request $request)
    {
        $cd =$request->cd;

        $terms = $request->terms;

        $d ='';

        if ($terms == 1) {
            $d = date('Y-m-d', strtotime($cd. ' + 1 days'));
        }
        if ($terms == 2) {
            $d .= date('Y-m-d', strtotime($cd. ' + 15 days'));
        }
        if ($terms == 3) {
            $d .= date('Y-m-d', strtotime($cd. ' + 30 days'));
        } 
        if ($terms == 4) {
            $d .= date('Y-m-d', strtotime($cd. ' + 60 days'));
        }

        echo $d;
    }

    public function saveproExpense (Request $request)
    {
        $data = array();

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['item_code'] = $request->item_code;
        $data['item_name'] = $request->item_name;
        $data['purchase'] = $request->purchase;
        $data['p_unit_price'] = $request->p_unit_price;
        $data['p_account'] = $request->p_account;
        $data['p_tax_rate'] = $request->p_tax_rate;
        $data['p_description'] = $request->p_description;
        $data['sell'] = $request->sell;
        $data['s_unit_price'] = $request->s_unit_price;
        $data['s_account'] = $request->s_account;
        $data['s_tax_rate'] = $request->s_tax_rate;
        $data['s_description'] = $request->s_description;
        $data['track'] = $request->track;
        $data['inventory_account'] = $request->inventory_account;

        if ($request->track > 0) {

            $data['sell'] = 1;
            $data['purchase'] = 1;
        }

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('products')->insert($data);

        session()->flash('success', 'Product Information Saved Successfully!');

        return redirect('/cubebooks/add-expense');
    }

    public function saveaccInvoice (Request $request)
    {
        $data = array();

        $data['user_id'] = $this->get_user_id(auth()->user()->id);
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

        return redirect('/cubebooks/add-invoice');
    }

    public function savetaxInvoice (Request $request)
    {
        // dd($request->all());
        $data = array();

        $data['user_id'] = $this->get_user_id(auth()->user()->id);
        $data['tax_name'] = $request->tax_name;
        $data['tax_amount'] = $request->tax_amount;

        $data['created_by'] = auth()->user()->id;

        DB::table('tax')->insert($data);

        session()->flash('success', 'Tax Information Saved Successfully!');

        return redirect('/cubebooks/add-invoice');
    }


    public function catchInvNumberup (Request $request)
    {
        $e = $request->val;

        $id = $request->inv_id;


        $inv = DB::table('invoices')->where('invoice_code',  $e)->where('invoice_id', '!=', $id)->exists();

        $ren = '';

        if ($inv) {

            $ren = '1';
        } else {
            $ren = '2';
        }

        echo $ren;


    }


    public function storeExpense (Request $request)
    {
        // dd($request->all());
        // exit();
        $data = array();
        $data['user_id'] = $this->get_user_id(auth()->user()->id);
        // $data['created_by'] = auth()->user()->id;
        // $data['created_date'] = date('Y-m-d');
        // $data['created_time'] = date('H:i:s');

        $data['supp_id'] = $request->cust_id;
        $data['invoice_code'] = $request->invoice_code;
        $data['terms'] = $request->terms;
        $data['payment_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $request->tax_ein;

        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;
      

        $data2 = array();

        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $discount = $request->discount;
        $account = $request->account;
        $tax = $request->tax;
        $tax_amount = $request->tax_amount;
        $amount = $request->amount;

        if ($request->approve !='' || $request->approve == 3) {

            for ($i = 0; $i < count($product); $i++) {

                $tax_text = explode('__',$tax[$i]);

                if (isset($tax_text[1]) == true) {

                    $data['status'] = 3;
                    $invoice_id = DB::table('expenses')->insertGetId($data);

                    $data2['expense_id'] = $invoice_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];

                    $data2['tax'] = $tax_text[0];
                    $data2['tax_id'] = $tax_text[1];

                    $data2['tax_amount'] = $tax_amount[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('expense_details')->insert($data2);

                    session()->flash('success', 'Information Saved Successfully!');
                    return redirect('/cubebooks/expenses');

                } else {

                    session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                    return redirect('/cubebooks/add-expense');
                }
            }
            
            session()->flash('success', 'Information Saved Successfully!');
            return redirect('/cubebooks/expenses');
        }

        if ($request->save_option > 0) {

            if ($request->save_option == 1) {

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1]) == true) {

                        $data['status'] = 1;
                        $invoice_id = DB::table('expenses')->insertGetId($data);

                        $data2['expense_id'] = $invoice_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                        
                        $data2['tax_amount'] = $tax_amount[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('expense_details')->insert($data2);

                        session()->flash('success', 'Information Saved Successfully!');
                        return redirect('/cubebooks/edit-invoice/'.$invoice_id);
                    }else {

                        session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                        return redirect('/cubebooks/add-expense');
                    }
                }
                
                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/edit-invoice/'.$invoice_id);

            } else if ($request->save_option == 2) {
                
                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1]) == true) {

                        $data['status'] = 2;
                        $invoice_id = DB::table('expenses')->insertGetId($data);

                        $data2['expense_id'] = $invoice_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];

                        $data2['tax_amount'] = $tax_amount[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('expense_details')->insert($data2);

                        session()->flash('success', 'Information Saved Successfully!');
                        return redirect('/cubebooks/expenses');

                    } else {

                        session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                        return redirect('/cubebooks/add-expense');
                    }
                }
                
                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/expenses');

            } else if ($request->save_option == 3) {

                for ($i = 0; $i < count($product); $i++) {

                    $data['status'] = 1;
                    $invoice_id = DB::table('expenses')->insertGetId($data);

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1]) == true) {

                        $data2['expense_id'] = $invoice_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];

                        $data2['tax_amount'] = $tax_amount[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('expense_details')->insert($data2);

                        session()->flash('success', 'Information Saved Successfully!');
                        return redirect('/cubebooks/add-expense');

                    }else {
                        session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                        return redirect('/cubebooks/add-expense');
                    }
                }
                
                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/add-expense');
            }

        } 
        else {

            for ($i = 0; $i < count($product); $i++) {

                $tax_text = explode('__',$tax[$i]);

                if (isset($tax_text[1]) == true) {

                    $data['status'] = 1;
                    $invoice_id = DB::table('expenses')->insertGetId($data);

                    $data2['expense_id'] = $invoice_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];
                    
                    $data2['tax'] = $tax_text[0];
                    $data2['tax_id'] = $tax_text[1];

                    $data2['tax_amount'] = $tax_amount[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('expense_details')->insert($data2);

                    session()->flash('success', 'Information Saved Successfully!');
                    return redirect('/cubebooks/expenses');

                } else {
                    
                    session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                    return redirect('/cubebooks/add-expense');
                }
            }
            
        }
    }

    public function updateExpense (Request $request)
    {

        $data = array();
        $data2 = array();

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        $data['supp_id'] = $request->cust_id;
        //$data['invoice_code'] = $request->invoice_code;
        $data['terms'] = $request->terms;
        $data['payment_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $request->tax_ein;

        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;

        $inv_id = $request->inv_id;
        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $discount = $request->discount;
        $account = $request->account;
        $tax = $request->tax;
        $tax_amount = $request->tax_amount;
        $amount = $request->amount;

        if ($request->approve !='' || $request->approve == 3) {

            $data['status'] = 3;

            DB::table('expenses')->where('expense_id', $inv_id)->update($data);

            DB::table('expense_details')->where('expense_id', $inv_id)->delete();


            if (isset($product) == true) {

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1]) == true) {
                    
                        $data2['expense_id'] = $inv_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];

                        $data2['tax_amount'] = $tax_amount[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('expense_details')->insert($data2);

                    } else {
                        session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                        return redirect('/cubebooks/edit-expense/'.$inv_id);

                    }
                }

            } else{
                session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                return redirect('/cubebooks/edit-expense/'.$inv_id);
            }
            session()->flash('success', 'Information update Successfully!');

            return redirect('/cubebooks/expenses');
        }


        if ($request->save_option > 0) {

            if ($request->save_option == 2) {

                $data['status'] = 2;

                DB::table('expenses')->where('expense_id', $inv_id)->update($data);

                DB::table('expense_details')->where('expense_id', $inv_id)->delete();

                if (isset($product) == true) {

                    for ($i = 0; $i < count($product); $i++) {

                        $tax_text = explode('__',$tax[$i]);

                        if (isset($tax_text[1]) == true) {

                            $data2['expense_id'] = $inv_id;
                            $data2['product_id'] = $product[$i];
                            $data2['description'] = $description[$i];
                            $data2['quantity'] = $quantity[$i];
                            $data2['rate'] = $rate[$i];
                            $data2['discount'] = $discount[$i];
                            $data2['account'] = $account[$i];
                            
                            $data2['tax'] = $tax_text[0];
                            $data2['tax_id'] = $tax_text[1];

                            $data2['tax_amount'] = $tax_amount[$i];
                            $data2['amount'] = $amount[$i];

                            $data2['created_by'] = auth()->user()->id;
                            $data2['created_date'] = date('Y-m-d');
                            $data2['created_time'] = date('H:i:s');

                            DB::table('expense_details')->insert($data2);

                        } else {
                            session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                            return redirect('/cubebooks/edit-expense/'.$inv_id);
                        }
                    }
                } else {
                    session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                    return redirect('/cubebooks/edit-expense/'.$inv_id);
                }

                session()->flash('success', 'Information Update Successfully!');
                return redirect('/cubebooks/expenses');

            } else if ($request->save_option == 3) {

                $data['status'] = 1;

                DB::table('expenses')->where('expense_id', $inv_id)->update($data);

                DB::table('expense_details')->where('expense_id', $inv_id)->delete();

                if (isset($product) == true) {

                    for ($i = 0; $i < count($product); $i++) {

                        $tax_text = explode('__',$tax[$i]);

                        if (isset($tax_text[1]) == true) {
                        
                            $data2['expense_id'] = $inv_id;
                            $data2['product_id'] = $product[$i];
                            $data2['description'] = $description[$i];
                            $data2['quantity'] = $quantity[$i];
                            $data2['rate'] = $rate[$i];
                            $data2['discount'] = $discount[$i];
                            $data2['account'] = $account[$i];
                            
                            $data2['tax'] = $tax_text[0];
                            $data2['tax_id'] = $tax_text[1];

                            $data2['tax_amount'] = $tax_amount[$i];
                            $data2['amount'] = $amount[$i];

                            $data2['created_by'] = auth()->user()->id;
                            $data2['created_date'] = date('Y-m-d');
                            $data2['created_time'] = date('H:i:s');

                            DB::table('expense_details')->insert($data2);
                        } else {

                            session()->flash('err', 'Sorry, Please select some item and complete your Expense');
                            return redirect('/cubebooks/edit-expense/'.$inv_id);
                        }
                    }
                } else {
                    session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                    return redirect('/cubebooks/edit-expense/'.$inv_id);
                }
                session()->flash('success', 'Information Update Successfully!');

                return redirect('/cubebooks/add-expense');
            }
        
        } else {
        
            $data['status'] = 1;

            DB::table('expenses')->where('expense_id', $inv_id)->update($data);

            DB::table('expense_details')->where('expense_id', $inv_id)->delete();

            $data2 = array();

            if (isset($product) == true) {

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1]) == true) {

                        $data2['expense_id'] = $inv_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];

                        $data2['tax_amount'] = $tax_amount[$i];
                        $data2['amount'] = $amount[$i];

                        DB::table('expense_details')->insert($data2);

                    } else {
                        session()->flash('err', 'Sorry, Please select some product and complete your Expense');
                        return redirect('/cubebooks/edit-expense/'.$inv_id);
                    }
                }
            } else {

                session()->flash('err', 'Sorry, Please select some product and complete your expense');
                return redirect('/cubebooks/edit-expense/'.$inv_id);
            }
            session()->flash('success', 'Information Update Successfully!');

            return redirect('/cubebooks/expenses');
        }
    }


    public function editExpense ($id)
    {
        $data = array();

        $data['f_inv_s'] = DB::table('inv_settings')->where('inv_id', 1)->first();

        $data['exp'] = $inv = DB::table('expenses')
            ->leftJoin('suppliers', 'expenses.supp_id', '=', 'suppliers.id')
            ->where('expenses.expense_id', $id)
            ->first();

        $data['exp_details'] = DB::table('expense_details as e_details')
                    ->leftJoin('products as p', 'e_details.product_id', '=', 'p.product_id')
                    ->leftJoin('account as a', 'e_details.account', '=', 'a.ac_id')
                    ->leftJoin('tax as t', 'a.tax_account', '=', 't.tax_id')
                    ->select(
                        'e_details.ex_details as ex_details',
                        'e_details.expense_id as id_expense_id',
                        'e_details.product_id as id_product_id',
                        'e_details.description as id_description',
                        'e_details.quantity as id_quantity',
                        'e_details.rate as id_rate',
                        'e_details.discount as id_discount',
                        'e_details.tax as id_tax',
                        'e_details.tax_amount as id_tax_amount',
                        'e_details.amount as id_amount',
                        'p.item_code as item_code',
                        'p.item_name as item_name',
                        'p.product_id as product_id',
                        'a.ac_name as ac_name',
                        'a.ac_id as ac_id',
                        't.tax_name as tax_name',
                        't.tax_id as tax_id'
                    )
                    ->where('e_details.expense_id', $id)
                    ->get();

        $data['accounts'] = DB::table('account')->get();
        $data['tax_rates'] = DB::table('tax')->get();
        $data['suppliers'] = DB::table('suppliers')->get();
        $data['products'] = DB::table('products')->get();
        
        $data["eaccount"] = DB::table('account')->where('ac_type', 10)->first();
        $data["taxs"] = DB::table('tax')->get();

        return view('pages.editExpense', $data);
    }

    public function viewExpense ($id) 
    {
        $check = DB::table('expenses')->where('expense_id', $id)->first();

        $data['invs'] = DB::table('inv_settings')->first();

        $data['inv'] = $inv = DB::table('expenses')
                    ->leftJoin('suppliers', 'expenses.supp_id', '=', 'suppliers.id')
                    ->where('expenses.expense_id', $id)
                    ->first();

        $data['in_pay_s'] = DB::table('expense_payments')->where('expense_id', $id)->sum('amount');


        $data['inv_details'] = DB::table('expense_details as i_details')
                            ->leftJoin('products as p', 'i_details.product_id', '=', 'p.product_id')
                            ->leftJoin('account as a', 'i_details.account', '=', 'a.ac_id')
                            ->leftJoin('tax as t', 'i_details.tax_id', '=', 't.tax_id')
                            ->select(
                                'i_details.ex_details as in_details',
                                'i_details.expense_id as id_invoice_id',
                                'i_details.product_id as id_product_id',
                                'i_details.description as id_description',
                                'i_details.quantity as id_quantity',
                                'i_details.rate as id_rate',
                                'i_details.discount as id_discount',
                                'i_details.tax as id_tax',
                                'i_details.tax_amount as id_tax_amount',
                                'i_details.amount as id_amount',
                                'p.item_code as item_code',
                                'p.item_name as item_name',
                                'a.ac_name as ac_name',
                                't.tax_name as tax_name'
                            )
                            ->where('i_details.expense_id', $id)
                            ->get();
                           
        $data['inv_payments'] = DB::table('expense_payments')->where('expense_id', $id)->get();

        $data['this_id'] = $id;

        if (isset($check)) {

            return view('pages.viewExpense', $data);

        } else {
            session()->flash('err', 'Please Don\'t Change the URL');

            return redirect('/');
        }
        
    }


    public function savePaymentExpense (Request $request)
    {   
        $data = array();

        $data['expense_id'] = $request->inv_id;
        $data['amount'] = $request->amount;
        $data['pay_date']= $request->pay_date;
        $data['account_id'] = $request->account_id;
        $data['reference'] = $request->reference;

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('expense_payments')->insert($data);

        session()->flash('success', 'Information Saved Successfully!');

        return redirect('/cubebooks/expenses');
    }

    public function catchInvInfo (Request $request)
    {
        $e = $request->invoice_id;

        $invs = DB::table('inv_settings')->first();

        $com_info = DB::table('company_info')->first();

        $inv = DB::table('invoices')
                    ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                    ->where('invoices.invoice_id', $e)
                    ->first();

        $in_pay_s = DB::table('inv_payment_details')->where('inv_id', $e)->sum('amount');


        $inv_details = DB::table('invoice_details as i_details')
                            ->leftJoin('products as p', 'i_details.product_id', '=', 'p.product_id')
                            ->leftJoin('account as a', 'i_details.account', '=', 'a.ac_id')
                            ->leftJoin('tax as t', 'i_details.tax_id', '=', 't.tax_id')
                            ->select(
                                'i_details.in_details as in_details',
                                'i_details.invoice_id as id_invoice_id',
                                'i_details.product_id as id_product_id',
                                'i_details.description as id_description',
                                'i_details.quantity as id_quantity',
                                'i_details.rate as id_rate',
                                'i_details.discount as id_discount',
                                'i_details.tax as id_tax',
                                'i_details.tax_amount as id_tax_amount',
                                'i_details.amount as id_amount',
                                'p.item_code as item_code',
                                'p.item_name as item_name',
                                'a.ac_name as ac_name',
                                't.tax_name as tax_name'
                            )
                            ->where('i_details.invoice_id', $e)
                            ->get();

        $inv_payments = DB::table('inv_payment_details')->where('inv_id', $e)->get();

        $pc = DB::table('countries')->where('id', $com_info->postal_country)->first();

        $sum_total = ($inv->final_total - $in_pay_s);

        $ren_data ='
            <div id="bill">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 pl-2">
                        <h2><b>INVOICE</b></h2>
                    </div>
                    <div class="col-md-6">
                        <img src="'.asset($com_info->com_logo).'" width="100%">
                    </div>
                </div>
            </div>
            <hr>
            <br>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 pl-2">

                        <table class="">
                            <tr>
                                <td class="inv_p">To</td>
                                <td class="text-left inv_p2">'.$inv->display_name.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Invoice Number</td>
                                <td class=" text-left inv_p2">'.$invs->inv_name.' '.$inv->invoice_code.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Reference Number</td>
                                <td class="text-left inv_p2">'.$inv->reference.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Issued</td>
                                <td class="text-left inv_p2">'.$inv->invoice_date.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Due</td>
                                <td class="text-left inv_p2">'.$inv->due_date.'</td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="col-md-6">
                        <table class="">
                            <tr>
                                <td class="inv_p vertical_top">From</td>
                                <td class="text-left inv_p2 inv_from">
                                    '.$com_info->trading_name.'
                                    <br>
                                    Attention: '.$com_info->postal_attention.'
                                    <br>
                                    '.$com_info->postal_address.'
                                    <br>
                                    <span class="uppercase">'.$com_info->postal_city.' '.$com_info->postal_stase .' '.$com_info->postal_code .'</span>
                                    <br>
                                    <span class="uppercase">'.$com_info->postal_country.'</span>
                                </td>
                            </tr>
                           
                        </table>    
                    </div>
                </div>
            </div>

            <br>
            <hr>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="pl-1">Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th class="text-right">Tax</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                   
        ';

        foreach ($inv_details as $item) {
            
            $ren_data .='
                <tr>
                    <td class="inv_p2 pl-1">'.$item->id_description.'</td>
                    <td class="inv_p2">'.$item->id_quantity.'</td>
                    <td class="inv_p2">'.$item->id_rate.'</td>
                    <td class="inv_p2 text-right">'.$item->tax_name.'</td>
                    <td class="inv_p2 text-right">'.$item->id_amount.'</td>
                </tr>

            ';
        }

        $ren_data .='
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="inv_p2 by_none pl-1">SubTotal</td>
                                    <td class="inv_p2 by_none text-right">'.$inv->sub_total.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <hr class="bold_hr">
                    </div>

                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-right by_none pr-5">TOTAL</td>
                                    <td class="inv_p2 by_none text-right">'.$inv->final_total.'</td>
                                </tr>
                                <tr>
                                    <td class="inv_p2 by_none pr-2">Less Amount Paid</td>
                                    <td class="inv_p2 by_none text-right">'.$in_pay_s.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <hr class="bold_hr2">
                    </div>

                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-center by_none pr-5 pl-1">AMOUNT DUE</td>
                                    <td class="inv_p2 by_none text-right">'.$sum_total.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            </div>

            <div class="col-md-12">
                <img src="'.asset('public/img/inv_dot.png').'" width="100%">
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="payment_color"><b>PAYMENT ADVICE</b></h2>
                        <table class="ml-2">
                            <tr>
                                <td class="inv_p vertical_top">To</td>
                                <td class="text-left inv_p2 inv_from">
                                    '.$com_info->trading_name.'
                                    <br>
                                    Attention: '.$com_info->postal_attention.'
                                    <br>
                                    '.$com_info->postal_address.'
                                    <br>
                                    <span class="uppercase">'.$com_info->postal_city.' '.$com_info->postal_stase .' '.$com_info->postal_code .'</span>
                                    <br>
                                    <span class="uppercase">'.$pc->name.'</span>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-md-6">
                        <table class="">
                            <tr>
                                <td class="inv_p">Customer</td>
                                <td class="text-left inv_p2">'.$inv->display_name.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Invoice Number</td>
                                <td class=" text-left inv_p2">'.$invs->inv_name.' '.$inv->invoice_code.'</td>
                            </tr>
                        </table>
                        <hr class="my-0">
                        <table>
                            <tr>
                                <td class="inv_p">Amount Due</td>
                                <td class="text-left inv_p2 pl-2">'.$sum_total.'</td>
                            </tr>
                            <tr>
                                <td class="inv_p">Due Date</td>
                                <td class="text-left inv_p2 pl-2">'.$inv->due_date.'</td>
                            </tr>
                        </table>
                        <hr class="my-0">
                        <table>
                            <tr>
                                <td class="inv_p">Amount Enclosed</td>
                                <td class="text-left inv_p2"></td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <hr class="my-0">
                                <span class="fs-11">Enter the amount you are paying above</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><br></div>
            </div>
        ';
        echo $ren_data;
    }

    //**** Mail send funciton ****//
    Public function sendinvmail (Request $request)
    {
        $e = $request->invoice_id;
        $email = $request->email;

        $com_info = DB::table('company_info')->first();
        
        $inv = DB::table('invoices')
                    ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                    ->where('invoices.invoice_id', $e)
                    ->first();
        
        $inv_name = DB::table('inv_settings')->first();
        
        $in_pay_s = DB::table('inv_payment_details')->where('inv_id', $e)->sum('amount');
        
        $sum_total = ($inv->final_total - $in_pay_s);
        

        // $email = 'fahadamin@outlook.com';
        
        $title = 'Invoice '.$inv_name->inv_name.$inv->invoice_code.' from '.$com_info->display_name.' for '.$inv->display_name;
        
        // $d['top'] = '<img src="'.asset($com_info->com_logo).'">';
        
        $d['first_chp'] = 'Here\'s invoice '.$inv_name->inv_name.$inv->invoice_code.' For '.$inv->final_total.'.';
        
        $d['second_chp'] = 'The amount outstanding of '.$sum_total.' is due on'.$inv->due_date.'.';
        
        $d['third_chp'] = 'View your bill online: http://cubeapps.co.za/cubebooks/view-invoice/1';
        
        $d['fourth_chp'] = 'Form your online bill can print a PDF, or create a free login and view your outstanding bills.';
        
        $d['fifth_chp'] = 'If you have any questions, please let us know.';
        
        $d['six_chp'] = 'Thanks,';
        $d['sev_chp'] = $com_info->display_name;
        
        $message = "Hi,\r\n \r\n".$d['first_chp']."\r\n \r\n".$d['second_chp']."\r\n \r\n".$d['third_chp']."\r\n \r\n".$d['fourth_chp']."\r\n \r\n".$d['fifth_chp']."\r\n \r\n".$d['six_chp']."\r\n".$d['sev_chp'];

        // mail($email,$title,$message);

        // $data = array(
        //     'name' => 'Fahad Amin',
        //     'message' => 'Fahad Amin'
        // );

        // Mail::to('fahadamin@outlook.com')->send(new SendMail($data));


        //********************************* Send Mail Start *********************************//
        
            $config = DB::table('smtp_settings')->first();

            $d['attachment'] = '';

            $flname = '';

            if($config->is_smtp == 1)
            {
                
                $data = [
                    'to' => $email,
                    'subject' => $title,
                    'body' => $message,
                    'filepath' => $flname
                ];

                $this->sendCustomMail($data);
                
            }
            else
            {
                $to = $email; 
                $from = $config->from_email;
                $fromName = $config->from_name; 
                $msg = $message;
                $subject = $title;
                
                
                if(isset($d['attachment'])){
                    
                    $fileatt = $flname; 
                    $fileatt_type = "application/pdf"; 
                    
                    $file_name_array = explode('/',$fileatt);
                    
                    $fileatt_name = $file_name_array[count($file_name_array)-1];
                    
                    $email_from = $config->from_name;  
                    
                    
                    $email_subject = $title; 
                    
                    
                    $email_message = '<html> 
                        <head> 
                            <title>'.$title.'</title> 
                        </head> 
                        <body> 
                            '.$msg.'
                        </body> 
                        </html>'; 
                    
                    $email_to = $user_email;
                    
                    $headers = "From: ".$email_from;
                    
                    //no need to change anything else under this point
                    
                    $file = fopen($fileatt,'rb'); 
                    $data = fread($file,filesize($fileatt)); 
                    fclose($file); 
                    
                    $semi_rand = md5(time()); 
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                    
                    $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""; 
                    
                    $email_message .= "This is a multi-part message in MIME format.\n\n" . 
                    "--{$mime_boundary}\n" . 
                    "Content-Type:text/html; charset=\"utf-8\"\n" . 
                    "Content-Transfer-Encoding: 7bit\n\n" . 
                    $email_message .= "\n\n"; 
                    
                    $data = chunk_split(base64_encode($data)); 
                    
                    $email_message .= "--{$mime_boundary}\n" . 
                    "Content-Type: {$fileatt_type};\n" . 
                    " name=\"{$fileatt_name}\"\n" . 
                    //"Content-Disposition: attachment;\n" . 
                    //" filename=\"{$fileatt_name}\"\n" . 
                    "Content-Transfer-Encoding: base64\n\n" . 
                    $data .= "\n\n" . 
                    "--{$mime_boundary}--\n"; 
                    
                    @mail($email_to, $email_subject, $email_message, $headers); 
                    
                }else {
                    
                    
                    $htmlContent = ' 
                        <html> 
                        <head> 
                            <title>'.$config->from_name.'</title> 
                        </head> 
                        <body> 
                            '.$message.'
                        </body> 
                        </html>'; 
                    
                    // Set content-type header for sending HTML email 
                    
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                    
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    // $headers .= 'Cc: welcome@example.com' . "\r\n"; 
                    // $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
                    
                    // Send email 
                    // if(){ 
                    //     echo 'Email has sent successfully.'; 
                    // }else{ 
                    //   echo 'Email sending failed.'; 
                    // }
                    
                    // dd($msg);
                    
                    mail($to, $subject, $htmlContent, $headers);
                    
                }
                
            }
        
        //********************************* Send Mail End **********************************//

        echo "1";
        // echo $e;
    }


    public static function get_acgrouptype_edit ($id, $not_this_id)
    {
        $e = DB::table('account')
            ->where('ac_group', $id)
            ->where('ac_id', '!=', $not_this_id)
            ->get();

        return $e;
    }


    public static function get_invoice ($id)
    {
        
        $e = DB::table('expenses')
            ->leftJoin('suppliers', 'expenses.supp_id', '=', 'suppliers.id')
            ->where('expenses.user_id', auth()->user()->id)
            ->where('expenses.status', $id)
            ->get();

        return $e;
    }


    private function sendCustomMail(array $mailData)
    {
        $setup = DB::table('smtp_settings')->first();

        $data = [
            'email_body' => $mailData['body']
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];
        $objDemo->pathToFile = $mailData['filepath'];
        
        
        if($mailData['filepath'] != ''){
            
            try{
                Mail::send('pages.mail_body',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                    $message->attach($objDemo->pathToFile);
                    
                });
            }
            catch (\Exception $e){
                // die("Not sent");
                session()->flash('err', 'Mail not sent..');
                return redirect()->back();
            }
            return true;
            
        }else{
            
            try{
                Mail::send('pages.mail_body',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                    
                });
            }
            catch (\Exception $e){
                // die("Not sent");
                session()->flash('err', 'Mail not sent..');
                return redirect()->back();
            }
            return true;
            
        }
    }


    public static function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }
}
