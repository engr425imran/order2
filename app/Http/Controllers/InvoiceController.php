<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Invoice;
use App\Invdetail;
use App\Setup;
use Auth;
use App\Mail\SendInvoiceMail;
use Response;
use DB;
use PDF;

use Illuminate\Support\Facades\Mail;

// use APP\Mail\SendMail;

class InvoiceController extends Controller
{
    public function manageInvoice() 
    {
        $data = array();
        $data["title"] = "Invoice Management";
        // $data["customers"] = Customer::get();
        // $data["products"] = Product::get();
        // $data["setups"] = Setup::find(1);

        $data['inv'] = DB::table('inv_settings')->first();

        $data["invoices"] = DB::table('invoices')
                            ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                            ->where('invoices.user_id', $this->get_user_id(auth()->user()->id))
                            ->orderBy('invoice_id', 'DESC')
                            ->get();

        return view('pages.invoices', $data);
    }

    public function addInvoice ()
    {

        
        $e['accounts'] = DB::table('account')->get();
        $e['tax_rates'] = DB::table('tax')->get();
        $e['inv_settings'] = DB::table('inv_settings')->where('user_id',$this->get_user_id(auth()->user()->id))->first();

        $e['customers'] = DB::table('customers')
            ->where('active_status', 1)
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->orderBy('display_name', 'ASC')
            ->get();

        $e['products'] = DB::table('products')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->get();
        
        $e["iaccount"] = DB::table('account')->where('ac_type', 10)->first();
        $e["taxs"] = DB::table('tax')->get();
        

        $e['cus_fields'] =DB::table('custom_more_field')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->get();

        $count_cust_field = DB::table('custom_more_field')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->count();

        if (isset($count_cust_field)) {

            $e['count_cus_fields'] = $count_cust_field;
        } else {
            $e['count_cus_fields'] = 1;
        }
        

        $last_inv = DB::table('invoices')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->orderBy('invoice_id', 'DESC')
                    ->first();
        $inv = DB::table('inv_settings')
                ->leftJoin('users', 'inv_settings.updated_by', '=', 'users.id')
                ->where('inv_settings.user_id', $this->get_user_id(auth()->user()->id))
                ->first();
                
        $e['a_inv_sum'] = DB::table('invoices')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->where('status', 3)->sum('final_total');
        
        $e['salesrep'] = DB::table('sales_rep')->where('user_id', auth()->user()->id)->get();

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

            $e['last_number'] = $last_number;

        } else {
            $e['inv'] = '';
            $e['last_number'] = 1;
        }

        return view('pages.addInvoice', $e);
    }

    public function catchProduct (Request $request)
    {
        $e = $request->val;

        if ( $e > 0 ){

            $data = DB::table('products')->where('product_id', $e)->first();
            $result = [];
            $result['product'] = $data;
            $result['product']->product_rate = $data->s_unit_price;

            if ( $data->s_account > 0){

                $sell_acc = DB::table('account')->where('ac_id', $data->s_account)->first();

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
                $result['product']->product_account = $ren_data;
                
            } else {
                $result['product']->product_account = '';
            }

            if ( $data->s_tax_rate > 0 ){

                $tax= DB::table('tax')->where('tax_id', $data->s_tax_rate)->first();

                $ren_tax ='<option value="'.$tax->tax_amount.'__'.$tax->tax_id.'">'.$tax->tax_name.' ('.$tax->tax_amount.' %)</option>';
                $ren_tax .='<option value="addNewTax" class="add_more">&#43; Add New Tax</option>';

                $all = DB::table('tax')->where('tax_id', '!=',$tax->tax_id)->get();

                foreach ($all as $t) {
                    $ren_tax .='<option value="'.$t->tax_amount.'__'.$t->tax_id.'">'.$t->tax_name.' ('.$t->tax_amount.' %)</option>';
                }
                $result['product']->product_tax = $ren_tax;

                $result['product']->tax_amount = $tax->tax_amount;
                
            } else {
                $result['product']->tax_amount = '';
                $result['product']->product_tax = '';
            }

            $ren_data = '<option value="0" disabled selected></option>';
            $ren_data .='<option value="addNewTax" class="add_more">&#43; Add New Tax</option>';

            if ($e > 0) {

                $data = DB::table('account')
                    ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                    ->where('ac_id', $data->s_account)->first();

                
                $ren_data .='<option value="'.$data->tax_amount.'__'.$data->tax_id.'" selected>'.$data->tax_name . ' (' . $data->tax_amount . ' % )'.'</option>';

                $taxs = DB::table('tax')->where('tax_id', '!=', $data->tax_id)->get();

                foreach ($taxs as $t) {

                    $ren_data .='<option value="'.$t->tax_amount.'__'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
                }

                $result['product']->accounts_tax =  $ren_data."___".$data->tax_amount;

                // echo $e;

            } else {

                $taxs = DB::table('tax')->get();

                foreach ($taxs as $t) {

                    $ren_data .='<option value="'.$t->tax_amount.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
                }

                $result['product']->accounts_tax =  $ren_data;
            }


            echo json_encode($result);
        } else {
            echo '';
        }
    }

    public function productRate (Request $request)
    {
        $e = $request->val;

        if ( $e > 0 ){

            $data = DB::table('products')->where('product_id', $e)->first();

            echo $data->s_unit_price;
        } else {
            echo '';
        }
    }

    public function productAcc (Request $request)
    {
        $e = $request->val;
        $data = DB::table('products')->where('product_id', $e)->first();
        if ( $data->s_account > 0){

            $sell_acc = DB::table('account')->where('ac_id', $data->s_account)->first();

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

    public function catchCustomer (Request $request)
    {
        $e = $request->val;

        $result = DB::table('customers')->where('cust_id', $e)->first();

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
        if ($request->invoice != 'new') {
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
                    <label>Delivery Address</label>
                    <textarea name="delivery_address" id="address" class="form-control form-control-sm p-1" rows="3">'.$result->c_street.' '.$result->c_city. ' '.$result->c_postal.' '.$result->c_country.'</textarea>
                </div>
            </div>

            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label>Billing Address</label>
                    <textarea name="billing_address" id="address" class="form-control form-control-sm p-1" rows="3">'.$result->b_street.' '.$result->b_city. ' '.$result->b_postal.' '.$result->b_country.'</textarea>
                </div>
            </div>
        ';
        }else{
            $ren_data ='
            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="'.$result->email.'">
                </div>
            </div>
            <div class="col-md-3 pull-left">
                                        
                <div class="form-group">
                    <label>Terms</label>
                    <select name="terms" class="form-control form-control-sm catch_terms">
                        '. $trems.'
                    </select>
                </div>
            </div>

            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label>Delivery Address</label>
                    <textarea name="delivery_address" id="address" class="form-control form-control-sm p-1" rows="3">'.$result->c_street.' '.$result->c_city. ' '.$result->c_postal.' '.$result->c_country.'</textarea>
                </div>
            </div>

            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label>Billing Address</label>
                    <textarea name="billing_address" id="address" class="form-control form-control-sm p-1" rows="3">'.$result->b_street.' '.$result->b_city. ' '.$result->b_postal.' '.$result->b_country.'</textarea>
                </div>
            </div>
        ';
        }
        
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


    public function saveproInvoice (Request $request)
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

        return redirect()->back();
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

    
    public function extraMorefield (Request $request)
    {
        $lvl_val = $request->lvl_val;

        $d['lvl_id'] = $lvl_val;
        $d['user_id'] = $this->get_user_id(auth()->user()->id);

        DB::table('custom_more_field')->insert($d);

        // echo "done";

    }

    public function extraMorefieldname (Request $request)
    {
        $lvl_val = $request->lvl_val;
        $label_name = $request->label_name;

        $exists = DB::table('custom_more_field')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->where('lvl_id', $lvl_val)
                    ->exists();


        if (isset($exists)) {

            $d['field_name'] = $label_name;

            DB::table('custom_more_field')
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->where('lvl_id', $lvl_val)
            ->update($d);

        }

        // echo $exists;
    }


    public function extraMorefielddel (Request $request)
    {
        $lvl_val = $request->lvl_val;

        DB::table('custom_more_field')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->where('lvl_id', $lvl_val)
                    ->delete();


    }


    public function extraMorefielddeledit (Request $request)
    {
        $lavel_del = $request->lavel_del;

        DB::table('invoice_more_field')
                    ->where('i_m_id', $lavel_del)
                    ->delete();
    }

    public function storeInvoice (Request $request)
    {
        $data = array();
        $data['user_id'] = $this->get_user_id(auth()->user()->id);
        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        $data['token'] = bin2hex(openssl_random_pseudo_bytes(10));
        $data['cust_id'] = $request->cust_id;
        $data['invoice_code'] =sprintf("%'.05d", $request->invoice_code);
        $data['terms'] = $request->terms;
        $data['invoice_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['email'] = $request->email;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $tax_ein = $request->tax_ein;

        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;
        $data['description'] = $request->inv_description;
        $data['note'] = $request->invoice_note;

        if($request->sales_rep != 'add_new_sales_rep'){
            $data['sales_rep'] = $request->sales_rep;
        }

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

        $new_label_name = $request->new_label_name;
        $new_field_data = $request->new_field_data;

        if ($request->approve !='' || $request->approve == 3) {
            $data['status'] = 3;
                $invoice_id = DB::table('invoices')->insertGetId($data);

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1])) {
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                    } else {

                        $data2['tax'] = 0;
                        $data2['tax_id'] = 0;
                    }
                    if ($tax_ein == 3 ) {

                        $data2['tax_amount'] = 0;
                    } else {
                        $data2['tax_amount'] = $tax_amount[$i];
                    }

                    $data2['invoice_id'] = $invoice_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('invoice_details')->insert($data2);

                }

                if (isset($new_label_name)) {
                    for ($i = 0; $i < count($new_label_name); $i++) {

                        $d3['invoice_id'] = $invoice_id;
                        $d3['new_label_name'] = $new_label_name[$i];
                        $d3['new_field_data'] = $new_field_data[$i];

                        $d3['created_by'] = auth()->user()->id;
                        $d3['created_date'] = date('Y-m-d');
                        $d3['created_time'] = date('H:i:s');

                        DB::table('invoice_more_field')->insert($d3);
                    }
                }
                
                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/invoices');
        }

        if ($request->save_option > 0) {

            if ($request->save_option == 1) {

                $data['status'] = 1;
                $invoice_id = DB::table('invoices')->insertGetId($data);

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1])) {
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                    } else {

                        $data2['tax'] = 0;
                        $data2['tax_id'] = 0;
                    }
                    if ($tax_ein == 3 ) {

                        $data2['tax_amount'] = 0;
                    } else {
                        $data2['tax_amount'] = $tax_amount[$i];
                    }

                    $data2['invoice_id'] = $invoice_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('invoice_details')->insert($data2);

                }

                if (isset($new_label_name)) {
                    for ($i = 0; $i < count($new_label_name); $i++) {

                        $d3['invoice_id'] = $invoice_id;
                        $d3['new_label_name'] = $new_label_name[$i];
                        $d3['new_field_data'] = $new_field_data[$i];
        
                        $d3['created_by'] = auth()->user()->id;
                        $d3['created_date'] = date('Y-m-d');
                        $d3['created_time'] = date('H:i:s');
        
                        DB::table('invoice_more_field')->insert($d3);
                    }
                }
            
                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/edit-invoice/'.$invoice_id);

            } else if ($request->save_option == 2) {

                if (true) {
                    
                    $data['status'] = 2;
                    $invoice_id = DB::table('invoices')->insertGetId($data);
                    
                    for ($i = 0; $i < count($product); $i++) {

                        $tax_text = explode('__',$tax[$i]);
                        if (isset($tax_text[1])) {

                            $data2['tax'] = $tax_text[0];
                            $data2['tax_id'] = $tax_text[1];
                        } else {
                            $data2['tax'] = 0;
                            $data2['tax_id'] = 0;
                        }
                        if ($tax_ein == 3 ) {

                            $data2['tax_amount'] = 0;
                        } else {
                            $data2['tax_amount'] = $tax_amount[$i];
                        }

                        $data2['invoice_id'] = $invoice_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('invoice_details')->insert($data2);
                    }
                    
                    if (isset($new_label_name)) {
                    
                        for ($i = 0; $i < count($new_label_name); $i++) {

                            $d3['invoice_id'] = $invoice_id;
                            $d3['new_label_name'] = $new_label_name[$i];
                            $d3['new_field_data'] = $new_field_data[$i];
            
                            $d3['created_by'] = auth()->user()->id;
                            $d3['created_date'] = date('Y-m-d');
                            $d3['created_time'] = date('H:i:s');
            
                            DB::table('invoice_more_field')->insert($d3);
                        }
                    }
                    session()->flash('success', 'Information Saved Successfully!');
                    return redirect('/cubebooks/invoices');

                } else {
                    session()->flash('err', 'Sorry, Please select some item and complete your invoice');
                    return redirect()->back();
                }

            } else if ($request->save_option == 3) {

                if (true) {

                    $data['status'] = 1;
                    $invoice_id = DB::table('invoices')->insertGetId($data);

                    for ($i = 0; $i < count($product); $i++) {

                        $tax_text = explode('__',$tax[$i]);

                        if (isset($tax_text[1])) {
                            $data2['tax'] = $tax_text[0];
                            $data2['tax_id'] = $tax_text[1];
                        } else {
                            $data2['tax'] = 0;
                            $data2['tax_id'] = 0;
                        }
                        if ($tax_ein == 3 ) {

                            $data2['tax_amount'] = 0;
                        } else {
                            $data2['tax_amount'] = $tax_amount[$i];
                        }

                        $data2['invoice_id'] = $invoice_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('invoice_details')->insert($data2);
                    }

                    if (isset($new_label_name)) {
                        for ($i = 0; $i < count($new_label_name); $i++) {

                            $d3['invoice_id'] = $invoice_id;
                            $d3['new_label_name'] = $new_label_name[$i];
                            $d3['new_field_data'] = $new_field_data[$i];
            
                            $d3['created_by'] = auth()->user()->id;
                            $d3['created_date'] = date('Y-m-d');
                            $d3['created_time'] = date('H:i:s');
            
                            DB::table('invoice_more_field')->insert($d3);
                        }
                    }
                    session()->flash('success', 'Information Saved Successfully!');
                    return redirect('/cubebooks/add-invoice');
                } else {
                    session()->flash('err', 'Sorry, Please select some item and complete your invoice');
                    return redirect()->back();
                }
            }

        } else {

            if (true) {
            
                $data['status'] = 1;
                $invoice_id = DB::table('invoices')->insertGetId($data);

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1])) {
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                    } else {

                        $data2['tax'] = 0;
                        $data2['tax_id'] = 0;
                    }

                    if ($tax_ein == 3 ) {

                        $data2['tax_amount'] = 0;
                    } else {
                        $data2['tax_amount'] = $tax_amount[$i];
                    }

                    $data2['invoice_id'] = $invoice_id;

                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];

                    
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('invoice_details')->insert($data2);
                }

                if (isset($new_label_name)) {

                    for ($s = 0; $s < count($new_label_name); $s++) {

                        $d3['invoice_id'] = $invoice_id;
                        $d3['new_label_name'] = $new_label_name[$s];
                        $d3['new_field_data'] = $new_field_data[$s];
        
                        $d3['created_by'] = auth()->user()->id;
                        $d3['created_date'] = date('Y-m-d');
                        $d3['created_time'] = date('H:i:s');
        
                        DB::table('invoice_more_field')->insert($d3);
                    }
                }

                session()->flash('success', 'Information Saved Successfully!');
                return redirect('/cubebooks/invoices');

            } else {
                session()->flash('err', 'Sorry, Please select some item and complete your invoice');
                return redirect('/cubebooks/add-invoice');
            }
            
        }
    }

    public function storeInvoiceAjax (Request $request){
        $data = array();
        $data['user_id'] = $this->get_user_id(auth()->user()->id);
        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        $data['cust_id'] = $request->cust_id;
        $data['invoice_code'] = sprintf("%'.05d", $request->invoice_code);;
        $data['terms'] = $request->terms;
        $data['invoice_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $tax_ein = $request->tax_ein;

        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;
        $data['description'] = $request->inv_description;
        $data['note'] = $request->invoice_note;

        if($request->sales_rep != 'add_new_sales_rep'){
            $data['sales_rep'] = $request->sales_rep;
        }

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

        $new_label_name = $request->new_label_name;
        $new_field_data = $request->new_field_data;

        $data['status'] = 2;
        $invoice_id = DB::table('invoices')->insertGetId($data);
        
        for ($i = 0; $i < count($product); $i++) {

            $tax_text = explode('__',$tax[$i]);
            if (isset($tax_text[1])) {

                $data2['tax'] = $tax_text[0];
                $data2['tax_id'] = $tax_text[1];
            } else {
                $data2['tax'] = 0;
                $data2['tax_id'] = 0;
            }
            if ($tax_ein == 3 ) {

                $data2['tax_amount'] = 0;
            } else {
                $data2['tax_amount'] = $tax_amount[$i];
            }

            $data2['invoice_id'] = $invoice_id;
            $data2['product_id'] = $product[$i];
            $data2['description'] = $description[$i];
            $data2['quantity'] = $quantity[$i];
            $data2['rate'] = $rate[$i];
            $data2['discount'] = $discount[$i];
            $data2['account'] = $account[$i];
            $data2['amount'] = $amount[$i];

            $data2['created_by'] = auth()->user()->id;
            $data2['created_date'] = date('Y-m-d');
            $data2['created_time'] = date('H:i:s');

            DB::table('invoice_details')->insert($data2);
        }
        
        if (isset($new_label_name)) {
        
            for ($i = 0; $i < count($new_label_name); $i++) {

                $d3['invoice_id'] = $invoice_id;
                $d3['new_label_name'] = $new_label_name[$i];
                $d3['new_field_data'] = $new_field_data[$i];

                $d3['created_by'] = auth()->user()->id;
                $d3['created_date'] = date('Y-m-d');
                $d3['created_time'] = date('H:i:s');

                DB::table('invoice_more_field')->insert($d3);
            }
        }

        return sprintf("%'.05d", $request->invoice_code);;

    }

    public function updateInvoice (Request $request)
    {

        $data = array();
        $data2 = array();

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        $data['cust_id'] = $request->cust_id;
        $data['invoice_code'] = sprintf("%'.05d", $request->invoice_code);;
        $data['terms'] = $request->terms;
        $data['invoice_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $tax_ein = $request->tax_ein;
        $data['email'] = $request->email;
        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;
        $data['description'] = $request->inv_description;
        $data['note'] = $request->invoice_note;

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

        $new_label_name = $request->new_label_name;
        $new_field_data = $request->new_field_data;

        if ($request->approve !='' || $request->approve == 3) {

            // dd($request->all());

                $data['status'] = 3;

                DB::table('invoices')->where('invoice_id', $inv_id)->update($data);
                DB::table('invoice_details')->where('invoice_id', $inv_id)->delete();
                DB::table('invoice_more_field')->where('invoice_id', $inv_id)->delete();
               

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1])) {
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                    } else {

                        $data2['tax'] = 0;
                        $data2['tax_id'] = 0;
                    }
                    if ($tax_ein == 3 ) {
                        $data2['tax_amount'] = 0;
                    } else {
                        $data2['tax_amount'] = $tax_amount[$i];
                    }
                    
                    $data2['invoice_id'] = $inv_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('invoice_details')->insert($data2);

                }

                if (isset($new_field_data)) {

                    for ($s = 0; $s < count($new_field_data); $s++) {

                        $d3['invoice_id'] = $inv_id;
                        $d3['new_label_name'] = $new_label_name[$s];
                        $d3['new_field_data'] = $new_field_data[$s];
        
                        $d3['created_by'] = auth()->user()->id;
                        $d3['created_date'] = date('Y-m-d');
                        $d3['created_time'] = date('H:i:s');
        
                        DB::table('invoice_more_field')->insert($d3);
                    }

                }

                session()->flash('success', 'Information update Successfully!');
                return redirect('/cubebooks/invoices');
        }


        if ($request->save_option > 0) {

            if ($request->save_option == 2) {

                 $data['status'] = 2;

                    DB::table('invoices')->where('invoice_id', $inv_id)->update($data);
                    DB::table('invoice_details')->where('invoice_id', $inv_id)->delete();
                    DB::table('invoice_more_field')->where('invoice_id', $inv_id)->delete();

                    for ($i = 0; $i < count($product); $i++) {

                        $tax_text = explode('__',$tax[$i]);

                        if (isset($tax_text[1])) {
                            $data2['tax'] = $tax_text[0];
                            $data2['tax_id'] = $tax_text[1];
                        } else {
    
                            $data2['tax'] = 0;
                            $data2['tax_id'] = 0;
                        }
                        if ($tax_ein == 3 ) {

                            $data2['tax_amount'] = 0;
                        } else {
                            $data2['tax_amount'] = $tax_amount[$i];
                        }

                        $data2['invoice_id'] = $inv_id;
                        $data2['product_id'] = $product[$i];
                        $data2['description'] = $description[$i];
                        $data2['quantity'] = $quantity[$i];
                        $data2['rate'] = $rate[$i];
                        $data2['discount'] = $discount[$i];
                        $data2['account'] = $account[$i];
                        $data2['amount'] = $amount[$i];

                        $data2['created_by'] = auth()->user()->id;
                        $data2['created_date'] = date('Y-m-d');
                        $data2['created_time'] = date('H:i:s');

                        DB::table('invoice_details')->insert($data2);

                    }

                    if (isset($new_field_data)) {

                        for ($s = 0; $s < count($new_field_data); $s++) {

                            $d3['invoice_id'] = $inv_id;
                            $d3['new_label_name'] = $new_label_name[$s];
                            $d3['new_field_data'] = $new_field_data[$s];
            
                            $d3['created_by'] = auth()->user()->id;
                            $d3['created_date'] = date('Y-m-d');
                            $d3['created_time'] = date('H:i:s');
            
                            DB::table('invoice_more_field')->insert($d3);
                        }

                    }

                    session()->flash('success', 'Information Update Successfully!');
                    return redirect('/cubebooks/invoices');

            } else if ($request->save_option == 3) {

                $data['status'] = 1;
                DB::table('invoices')->where('invoice_id', $inv_id)->update($data);
                DB::table('invoice_details')->where('invoice_id', $inv_id)->delete();
                DB::table('invoice_more_field')->where('invoice_id', $inv_id)->delete();

                for ($i = 0; $i < count($product); $i++) {

                    $tax_text = explode('__',$tax[$i]);

                    if (isset($tax_text[1])) {
                        $data2['tax'] = $tax_text[0];
                        $data2['tax_id'] = $tax_text[1];
                    } else {

                        $data2['tax'] = 0;
                        $data2['tax_id'] = 0;
                    }
                    if ($tax_ein == 3 ) {

                        $data2['tax_amount'] = 0;
                    } else {
                        $data2['tax_amount'] = $tax_amount[$i];
                    }
                    
                    $data2['invoice_id'] = $inv_id;
                    $data2['product_id'] = $product[$i];
                    $data2['description'] = $description[$i];
                    $data2['quantity'] = $quantity[$i];
                    $data2['rate'] = $rate[$i];
                    $data2['discount'] = $discount[$i];
                    $data2['account'] = $account[$i];
                    $data2['amount'] = $amount[$i];

                    $data2['created_by'] = auth()->user()->id;
                    $data2['created_date'] = date('Y-m-d');
                    $data2['created_time'] = date('H:i:s');

                    DB::table('invoice_details')->insert($data2);

                }
                
                if (isset($new_field_data)) {

                    for ($s = 0; $s < count($new_field_data); $s++) {

                        $d3['invoice_id'] = $inv_id;
                        $d3['new_label_name'] = $new_label_name[$s];
                        $d3['new_field_data'] = $new_field_data[$s];
        
                        $d3['created_by'] = auth()->user()->id;
                        $d3['created_date'] = date('Y-m-d');
                        $d3['created_time'] = date('H:i:s');
        
                        DB::table('invoice_more_field')->insert($d3);
                    }

                }

                session()->flash('success', 'Information Update Successfully!');
                return redirect('/cubebooks/add-invoice');
            }
        
        } else {
    
            $data['status'] = 1;

            DB::table('invoices')->where('invoice_id', $inv_id)->update($data);
            DB::table('invoice_details')->where('invoice_id', $inv_id)->delete();
            DB::table('invoice_more_field')->where('invoice_id', $inv_id)->delete();

            $data2 = array();

            for ($i = 0; $i < count($product); $i++) {

                $tax_text = explode('__',$tax[$i]);

                if (isset($tax_text[1])) {
                    $data2['tax'] = $tax_text[0];
                    $data2['tax_id'] = $tax_text[1];
                } else {

                    $data2['tax'] = 0;
                    $data2['tax_id'] = 0;
                }
                if ($tax_ein == 3 ) {

                    $data2['tax_amount'] = 0;
                } else {
                    $data2['tax_amount'] = $tax_amount[$i];
                }

                $data2['invoice_id'] = $inv_id;
                $data2['product_id'] = $product[$i];
                $data2['description'] = $description[$i];
                $data2['quantity'] = $quantity[$i];
                $data2['rate'] = $rate[$i];
                $data2['discount'] = $discount[$i];
                $data2['account'] = $account[$i];
                $data2['amount'] = $amount[$i];

                DB::table('invoice_details')->insert($data2);
            }

            if (isset($new_field_data)) {

                for ($s = 0; $s < count($new_field_data); $s++) {

                    $d3['invoice_id'] = $inv_id;
                    $d3['new_label_name'] = $new_label_name[$s];
                    $d3['new_field_data'] = $new_field_data[$s];
    
                    $d3['created_by'] = auth()->user()->id;
                    $d3['created_date'] = date('Y-m-d');
                    $d3['created_time'] = date('H:i:s');
    
                    DB::table('invoice_more_field')->insert($d3);
                }

            }

            session()->flash('success', 'Information Update Successfully!');
            return redirect('/cubebooks/invoices');

        }
    }

    public function updateInvoiceAjax (Request $request)
    {

        $data = array();
        $data2 = array();

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        $data['cust_id'] = $request->cust_id;
        $data['invoice_code'] = sprintf("%'.05d", $request->invoice_code);;
        $data['terms'] = $request->terms;
        $data['invoice_date'] = $request->invoice_date;
        $data['due_date'] = $request->due_date;
        $data['reference'] = $request->reference;
        $data['tax_ein'] = $tax_ein = $request->tax_ein;

        $data['sub_total'] = $request->sub_total;
        $data['adjustment_tax'] = $request->adjustment_tax;
        $data['final_total'] = $request->final_total;
        $data['description'] = $request->inv_description;
        $data['note'] = $request->invoice_note;
        $data['invoice_status'] = 'Printed';
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

        $new_label_name = $request->new_label_name;
        $new_field_data = $request->new_field_data;

        if ($product[0] !='') {

            $data['status'] = 2;
            

            DB::table('invoices')->where('invoice_id', $inv_id)->update($data);
            DB::table('invoice_details')->where('invoice_id', $inv_id)->delete();
            DB::table('invoice_more_field')->where('invoice_id', $inv_id)->delete();

            for ($i = 0; $i < count($product); $i++) {

                $tax_text = explode('__',$tax[$i]);

                if (isset($tax_text[1])) {
                    $data2['tax'] = $tax_text[0];
                    $data2['tax_id'] = $tax_text[1];
                } else {

                    $data2['tax'] = 0;
                    $data2['tax_id'] = 0;
                }
                if ($tax_ein == 3 ) {

                    $data2['tax_amount'] = 0;
                } else {
                    $data2['tax_amount'] = $tax_amount[$i];
                }

                $data2['invoice_id'] = $inv_id;
                $data2['product_id'] = $product[$i];
                $data2['description'] = $description[$i];
                $data2['quantity'] = $quantity[$i];
                $data2['rate'] = $rate[$i];
                $data2['discount'] = $discount[$i];
                $data2['account'] = $account[$i];
                $data2['amount'] = $amount[$i];

                $data2['created_by'] = auth()->user()->id;
                $data2['created_date'] = date('Y-m-d');
                $data2['created_time'] = date('H:i:s');

                DB::table('invoice_details')->insert($data2);

            }

            if (isset($new_field_data)) {

                for ($s = 0; $s < count($new_field_data); $s++) {

                    $d3['invoice_id'] = $inv_id;
                    $d3['new_label_name'] = $new_label_name[$s];
                    $d3['new_field_data'] = $new_field_data[$s];
    
                    $d3['created_by'] = auth()->user()->id;
                    $d3['created_date'] = date('Y-m-d');
                    $d3['created_time'] = date('H:i:s');
    
                    DB::table('invoice_more_field')->insert($d3);
                }

            }
            return sprintf("%'.05d", $request->invoice_code);

        } else {
            return 0;

        }
        

    }



    public function editInvoice ($id)
    {
        $data = array();

        $data['f_inv_s'] = DB::table('inv_settings')->where('inv_id', 1)->first();

        $data['inv'] = Invoice::with('customer')
                        ->where('invoices.invoice_id', $id)
            ->select('invoices.invoice_id','invoices.user_id', 'invoices.invoice_code', 'invoices.cust_id', 'invoices.sales_rep', 'invoices.terms', 'invoices.invoice_date', 'invoices.reference', 'invoices.description', 'invoices.tax_ein', 'invoices.due_date', 'invoices.sub_total', 'invoices.adjustment_tax', 'invoices.final_total','invoices.email', 'invoices.status as inv_status', 'invoices.note as inv_note', 'invoices.created_by as inv_created_by', 'invoices.created_date as inv_created_date', 'invoices.created_time as inv_created_time', 'invoices.updated_by as inv_updated_by', 'invoices.updated_date as inv_updated_date', 'invoices.updated_time as inv_updated_time')
            ->first();
       
        $data['inv_settings'] = DB::table('inv_settings')->where('user_id',$this->get_user_id(auth()->user()->id))->first();

        $data['inv_details'] = DB::table('invoice_details as i_details')
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
                        'i_details.tax as i_tax_amount',
                        'i_details.tax_id as i_tex_id',
                        'i_details.tax_amount as id_tax_amount',
                        'i_details.amount as id_amount',
                        'p.item_code as item_code',
                        'p.item_name as item_name',
                        'p.product_id as product_id',
                        'a.ac_name as ac_name',
                        'a.ac_id as ac_id',
                        'a.ac_number as ac_number',
                        't.tax_name as tax_name',
                        't.tax_id as tax_id'
                    )
                    ->where('i_details.invoice_id', $id)
                    ->get();

        $data['accounts'] = DB::table('account')->get();
        $data['tax_rates'] = DB::table('tax')->get();
        $data['customers'] = DB::table('customers')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->orderBy('display_name', 'ASC')
                                ->get();
        $data['products'] = DB::table('products')->where('user_id', $this->get_user_id(auth()->user()->id))->get();
        
        $data["iaccount"] = DB::table('account')->where('ac_type', 10)->first();
        $data["taxs"] = DB::table('tax')->get();
        
        $data["inv_more_fields"] = DB::table('invoice_more_field')->where('invoice_id', $id)->get();

        $data['a_inv_sum'] = DB::table('invoices')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('status', 3)
                ->sum('final_total');
        $data['salesrep'] = DB::table('sales_rep')->where('user_id', auth()->user()->id)->get();

        return view('pages.editInvoice', $data);
    }

    public function viewInvoice ($id) 
    {
        $check = DB::table('invoices')->where('invoice_id', $id)->first();

        $data['invs'] = DB::table('inv_settings')->first();

        $data['inv'] = $inv = Invoice::with('customer')
                    ->where('invoices.invoice_id', $id)
                    ->first();

        $data['in_pay_s'] = DB::table('inv_payment_details')->where('inv_id', $id)->sum('amount');


        $data['inv_details'] = DB::table('invoice_details as i_details')
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
                                't.tax_name as tax_name',
                                't.tax_amount as tax_amount'
                            )
                            ->where('i_details.invoice_id', $id)
                            ->get();

        $data['inv_payments'] = DB::table('inv_payment_details')->where('inv_id', $id)->get();
        
        $data["inv_more_fields"] = DB::table('invoice_more_field')->where('invoice_id', $id)->get();

        $data['a_inv_sum'] = DB::table('invoices')
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->where('status', 3)->sum('final_total');

        $data['this_id'] = $id;

        if (isset($check)) {

            return view('pages.viewInvoice', $data);

        } else {
            session()->flash('err', 'Please Don\'t Change the URL');

            return redirect('/');
        }
        
    }


    public function savePaymentInvoice (Request $request)
    {
        $data = array();

        $data['inv_id'] = $request->inv_id;
        $data['amount'] = $request->amount;
        $data['pay_date']= $request->pay_date;
        $data['account_id'] = $request->account_id;
        $data['reference'] = $request->reference;

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('inv_payment_details')->insert($data);

        session()->flash('success', 'Information Saved Successfully!');

        return redirect('/cubebooks/invoices');
    }

    public function catchInvInfo (Request $request)
    {
        $e = $request->invoice_id;
        $user = Auth::user();
        $com_info = DB::table('company_info')->where('user_id', $user->id)->first();
        $invs = DB::table('inv_settings')->where('user_id', $user->id)->first();

        $inv = DB::table('invoices')
                    ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                    ->where('invoices.invoice_id', $e)
                    ->first();

        $customer = DB::table('customers')
                    ->where('cust_id', $inv->cust_id)
                    ->first();

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
        

        $data = [];

        $data['inv_details'] = $inv_details;

        $data['inv'] = $inv;
        $data['com_info'] = $com_info;
        $data['invs'] = $invs;
        $data['customer'] = $customer;

        $t_tax = 0;

        if ($inv->sales_rep) {
            $salesrep = DB::table('sales_rep')->where('id', $inv->sales_rep)->first();
            $data['salesrep'] = $salesrep->firstname . ' '. $salesrep->lastname;
        }else{
            $data['salesrep'] = '';
        }
        
            foreach($inv_details as $i_d){
                $t_tax += $i_d->id_tax_amount;
            }
        $data['t_tax'] = $t_tax;

        return view('pages.invoice-templates.invoice-'.$invs->template??'1', $data);
    }
    public function updateInvoiceStatus($id){
        $invoice = Invoice::find($id);

        $invoice->invoice_status = 'Printed';
        $invoice->status = 2;
        $invoice->update();

        return 1;
    }

    public function updateInvoicePrintStatus($id){
        $invoice = Invoice::find($id);
        $invoice->invoice_status = 'Printed';
        $invoice->update();
        return 1;
    }

  
    public function invoicestatus(Request $request){
        $invoice = Invoice::where('token' ,$request->token)->first();
        $invoice->status = 3;
        $invoice->update();
        $notify = array('status' => 1, 'message' => 'Invoice Successfully Approved!');
        return Response::json($notify);
    }

    public function invoiceshow(){
        return view('pages.invoice-show');
    }

    public function invoicesendmail(Request $request){
        $invoice = Invoice::with('customer')->where('invoice_id', $request->invoice_id)->first();

        if ($invoice) {
            $subject = 'Invoice';

            $user = Auth::user();
            $com_info = DB::table('company_info')->where('user_id', $user->id)->first();
            $invs = DB::table('inv_settings')->where('user_id', $user->id)->first();

            $inv = DB::table('invoices')
                        ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
                        ->where('invoices.invoice_id', $request->invoice_id)
                        ->first();

            $customer = DB::table('customers')
                        ->where('cust_id', $inv->cust_id)
                        ->first();

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
                                ->where('i_details.invoice_id', $request->invoice_id)
                                ->get();
            

            $data = [];

            $data['inv_details'] = $inv_details;

            $data['inv'] = $inv;
            $data['com_info'] = $com_info;
            $data['invs'] = $invs;
            $data['customer'] = $customer;

            $t_tax = 0;

            if ($inv->sales_rep) {
                $salesrep = DB::table('sales_rep')->where('id', $inv->sales_rep)->first();
                $data['salesrep'] = $salesrep->firstname . ' '. $salesrep->lastname;
            }else{
                $data['salesrep'] = '';
            }
            
                foreach($inv_details as $i_d){
                    $t_tax += $i_d->id_tax_amount;
                }
            $data['t_tax'] = $t_tax;

            $pdf = PDF::loadView('pages.invoice-templates.invoice-'.$invs->template??'1', $data);
            $data['email'] = $request->email;
            $data['subject'] = 'Invoice Sent';
            $data['client_name'] = 'John Doe';
            $data['invoice'] = $invoice;


            Mail::send('emails.send-invoice', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
            // file_put_contents('public/invoice/inv-'.$invoice->invoice_id.'.pdf', base64_decode($request->pdf));
            // Mail::to($request->email)->send(new SendInvoiceMail($invoice, $pdf));
            $invoice->invoice_status = 'Sent';
                $invoice->update();
                $notify = array('status' => 1, 'message' => 'Invoice Sent Successfully!');
            
        }else{
            $notify = array('status' => 0, 'message' => 'Something went wrong! Please try again');
        }

        return Response::json($notify);
    }

    public function invPrintPrev (Request $request)
    {
        $inv = $request;
        // return response()->json($inv);
        // exit;
        $invs = DB::table('inv_settings')->first();
        $com_info = DB::table('company_info')->first();
        $customer = DB::table('customers')
                    ->where('cust_id', $inv->cust_id)
                    ->first();
        $user = Auth::user();
        $com_info = DB::table('company_info')->where('user_id', $user->id)->first();
        $invs = DB::table('inv_settings')->where('user_id', $user->id)->first();


        $customer = DB::table('customers')
                    ->where('cust_id', $inv->cust_id)
                    ->first();
        $t_tax = 0;
        $inv_details = [];
        for($i = 0; $i < count($inv->product); $i++){
            if($inv->product[$i] != null){
                $t_tax += isset($inv->tax_amount[$i]) ? $inv->tax_amount[$i] : 0;
                $description = isset($inv->description[$i]) ? $inv->description[$i] : '';
                $quantity = isset($inv->quantity[$i]) ? $inv->quantity[$i] : 0;
                $rate = isset($inv->rate[$i]) ? $inv->rate[$i] : 0;
                $discount = isset($inv->discount[$i]) ? $inv->discount[$i] : 0;
                $tax = isset($inv->tax[$i]) ? $inv->tax[$i] : 0;
                $tax = explode('__', $tax);
                $tax = $tax[0] * $rate / 100;
                $amount  = isset($inv->amount[$i]) ? $inv->amount[$i] : 0;
                $inv_details[$i] = new \stdClass();
                $inv_details[$i]->id_description =$description;
                $inv_details[$i]->id_quantity =$quantity;
                $inv_details[$i]->id_rate =$rate;
                $inv_details[$i]->id_discount =$discount;
                $inv_details[$i]->tax_name =$tax;
                $inv_details[$i]->id_amount =$amount;

            }
            
        }
        

        $data = [];

        $data['inv_details'] = $inv_details;

        $data['inv'] = $inv;
        $data['com_info'] = $com_info;
        $data['invs'] = $invs;
        $data['customer'] = $customer;

        if ($inv->sales_rep) {
            $salesrep = DB::table('sales_rep')->where('id', $inv->sales_rep)->first();
            $data['salesrep'] = $salesrep->firstname . ' '. $salesrep->lastname;
        }else{
            $data['salesrep'] = '';
        }
        
        $data['t_tax'] = $t_tax;

        return view('pages.invoice-templates.invoice-'.$invs->template??'1', $data);

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
        
            $company_info = DB::table('company_info')->where('user_id', Auth::user()->id)->first();

            $d['attachment'] = '';

            $flname = '';

            
            $to = $email; 
            $from = $company_info->com_email;
            $fromName = $company_info->display_name; 
            $msg = $message;
            $subject = $title;
                
                
            if(isset($d['attachment']) and $d['attachment'] != ''){
                
                $fileatt = $flname; 
                $fileatt_type = "application/pdf"; 
                
                $file_name_array = explode('/',$fileatt);
                
                $fileatt_name = $file_name_array[count($file_name_array)-1];
                
                $email_from = $company_info->display_name;  
                
                
                $email_subject = $title; 
                
                
                $email_message = '<html> 
                    <head> 
                        <title>'.$title.'</title> 
                    </head> 
                    <body> 
                        '.$msg.'
                    </body> 
                    </html>'; 
                
                $email_to = $email;
                
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
                        <title>'.$company_info->display_name.'</title> 
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
        
        $e = DB::table('invoices')
            ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
            ->where('invoices.user_id', auth()->user()->id)
            ->where('invoices.status', $id)
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

    public function saveSalesRep(Request $request){
        $sales_rep = array(
            'user_id' => auth()->user()->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'active' => isset($request->active) ? 1 : 0,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile
        );

        $insert = DB::table('sales_rep')->insert($sales_rep);

        if($insert){
            $get_sales_rep = DB::table('sales_rep')->where('id', DB::getPdo()->lastInsertId())->first();

            return response()->json(array('success' => true, 'msg' => 'New Sales Rep Added.', 'details' => $get_sales_rep));
        }
    }
}
