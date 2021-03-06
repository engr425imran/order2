<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function manageProduct() 
    {
        $data = array();
        $data["title"] = "Products & Services";
        $data["accounts"] = DB::table('account')->get();
        $data["account_types"] = DB::table('account_type')->get();
        $data["iaccount"] = DB::table('account')->where('ac_type', 10)->first();
        $data["taxs"] = DB::table('tax')->get();
        
        $data["products"] = DB::table('products')
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->get();

        return view('pages.products', $data);
    }

    
    Public function ptaxinfo (Request $request)
    {
        $e = $request->ac_id;


        $acc_info = DB::table('account')
        ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
        ->where('account.ac_id', $e)
        ->first();


        $ren_tax ='<option value="'.$acc_info->tax_id.'" selected>'.$acc_info->tax_name . ' (' . $acc_info->tax_amount . ' % )'.'</option>';


        $taxs = DB::table('tax')->where('tax_id', '!=', $acc_info->tax_id)->get();

        foreach ($taxs as $t) {

            $ren_tax .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
        }

        echo $ren_tax;
    }

    Public function staxinfo (Request $request)
    {
        $e = $request->ac_id;

        $acc_info = DB::table('account')
                ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                ->where('account.ac_id', $e)
                ->first();


        $ren_tax ='<option value="'.$acc_info->tax_id.'" selected>'.$acc_info->tax_name . ' (' . $acc_info->tax_amount . ' % )'.'</option>';


        $taxs = DB::table('tax')->where('tax_id', '!=', $acc_info->tax_id)->get();

        foreach ($taxs as $t) {

            $ren_tax .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
        }
        
        echo $ren_tax;
    }

    public function storepro (Request $request)
    {
        // dd($request->all());
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

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('products')->insert($data);

        session()->flash('success', 'Product Information Saved Successfully!');

        return redirect('/cubebooks/products');
    }

    public function infoProduct ($id)
    {
        // echo $id;
        $e = DB::table('products')->where('product_id', $id)->first();

        if (isset($e)) {

            $data = array();
            $p = DB::table('products')
                ->leftJoin('account', 'products.p_account', '=', 'account.ac_id')
                ->leftJoin('tax', 'products.p_tax_rate', '=', 'tax.tax_id')
                ->where('products.product_id', $id)->first();

            $d['item_name'] = $p->item_name;
            $d['item_code'] = $p->item_code;
            $d['p_info'] = $p;
            $d['s_account'] = DB::table('account')->where('ac_id', $p->s_account)->first();
            $d['s_tax_rate'] = DB::table('tax')->where('tax_id', $p->s_tax_rate)->first();

            return view('pages.products_details', $d);

        } else {
            session()->flash('err', 'Sorry the item not found');

            return redirect('cubebooks/products');
        }
    }

    public function proInfoedit (Request $request)
    {
        $e = $request->prduct_id;

        $p = DB::table('products')
                ->leftJoin('account', 'products.p_account', '=', 'account.ac_id')
                ->leftJoin('tax', 'products.p_tax_rate', '=', 'tax.tax_id')
                ->where('products.product_id', $e)
                ->first();

        
        // Purchase item unit price
        $p_u_p = ($p->p_unit_price) ? $p->p_unit_price : '';

        // Purchase item account
        $p_true_a = ($p->p_account) ? $p->p_account : '';

        $p_ac = DB::table('account')->where('ac_id', $p_true_a)->first();

        if (isset($p_ac->ac_id)) {

            $ren_acc_p = '<option value="'.$p_ac->ac_id.'">'. $p_ac->ac_number.' - '.$p_ac->ac_name.'</option>';
            
            $ac_type_1 = $this->get_acgrouptype_edit(1, $p_ac->ac_id);
            $ac_type_2 = $this->get_acgrouptype_edit(2, $p_ac->ac_id);
            $ac_type_3 = $this->get_acgrouptype_edit(3, $p_ac->ac_id);
            $ac_type_4 = $this->get_acgrouptype_edit(4, $p_ac->ac_id);
            $ac_type_5 = $this->get_acgrouptype_edit(5, $p_ac->ac_id);

            $ren_acc_1 = $ren_acc_2 = $ren_acc_3 = $ren_acc_4 = $ren_acc_5 ='';
            foreach ($ac_type_1 as $a) {

                $ren_acc_1 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_2 as $a) {

                $ren_acc_2 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_3 as $a) {

                $ren_acc_3 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_4 as $a) {

                $ren_acc_4 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_5 as $a) {

                $ren_acc_5 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }

        } else {
            $ren_acc_p = '<option value=""></option>';

            $ac_type_1 = $this->get_acgrouptype(1);
            $ac_type_2 = $this->get_acgrouptype(2);
            $ac_type_3 = $this->get_acgrouptype(3);
            $ac_type_4 = $this->get_acgrouptype(4);
            $ac_type_5 = $this->get_acgrouptype(5);

            $ren_acc_1 = $ren_acc_2 = $ren_acc_3 = $ren_acc_4 = $ren_acc_5 ='';

            foreach ($ac_type_1 as $a) {

                $ren_acc_1 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_2 as $a) {

                $ren_acc_2 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_3 as $a) {

                $ren_acc_3 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_4 as $a) {

                $ren_acc_4 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
            foreach ($ac_type_5 as $a) {

                $ren_acc_5 .='<option value="'.$a->ac_id.'">'.$a->ac_number.' - '.$a->ac_name .'</option>';
            }
        }


        // Purchase item tax
        $p_true_t = ($p->p_tax_rate) ? $p->p_tax_rate : '';

        $p_tax = DB::table('tax')->where('tax_id', $p_true_t)->first();  

        if (isset($p_tax->tax_id)) {

            $ren_p_tax = DB::table('tax')->where('tax_id', $p_tax->tax_id)->first();

            $ren_tax_p ='<option value="'.$ren_p_tax->tax_id.'">'.$ren_p_tax->tax_name . ' (' . $ren_p_tax->tax_amount . ' % )'.'</option>';

            $taxs = DB::table('tax')->where('tax_id', '!=', $ren_p_tax->tax_id)->get();

            foreach ($taxs as $t) {
    
                $ren_tax_p .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }
        } else {
            $ren_tax_p ='<option value=""></option>';
            $taxs = DB::table('tax')->get();

            foreach ($taxs as $t) {
    
                $ren_tax_p .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }
        }

        // Purchase item desc
        $p_desc = ($p->p_description) ? $p->p_description : '';
        
        
        // Sell item unit price
        $s_u_p = ($p->s_unit_price) ? $p->s_unit_price : '';

        // Sell item account
        $s_true_a = ($p->s_account) ? $p->s_account : '';

        $p_acs = DB::table('account')->where('ac_id', $s_true_a)->first();

        if (isset($p_acs->ac_id)) {

            $ren_acc_s = '<option value="'.$p_acs->ac_id.'">'.$p_acs->ac_number.' - '.$p_acs->ac_name .'</option>';

            
            $ac_type_s_1 = $this->get_acgrouptype_edit(1, $p_acs->ac_id);
            $ac_type_s_2 = $this->get_acgrouptype_edit(2, $p_acs->ac_id);
            $ac_type_s_3 = $this->get_acgrouptype_edit(3, $p_acs->ac_id);
            $ac_type_s_4 = $this->get_acgrouptype_edit(4, $p_acs->ac_id);
            $ac_type_s_5 = $this->get_acgrouptype_edit(5, $p_acs->ac_id);

            $ren_acc_s_1 = $ren_acc_s_2 = $ren_acc_s_3 = $ren_acc_s_4 = $ren_acc_s_5 ='';

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
        } else {
            $ren_acc_s = '<option value=""></option>';

            $ren_acc_s_1 = $ren_acc_s_2 = $ren_acc_s_3 = $ren_acc_s_4 = $ren_acc_s_5 ='';

            $ac_type_s_1 = $this->get_acgrouptype(1);
            $ac_type_s_2 = $this->get_acgrouptype(2);
            $ac_type_s_3 = $this->get_acgrouptype(3);
            $ac_type_s_4 = $this->get_acgrouptype(4);
            $ac_type_s_5 = $this->get_acgrouptype(5);

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
        }

        // Sell item tax
        $s_true_t = ($p->s_tax_rate) ? $p->s_tax_rate : '';

        $p_tax_s = DB::table('tax')->where('tax_id', $s_true_t)->first();

        if (isset($p_tax_s->tax_id)) {

            $ren_s_tax = DB::table('tax')->where('tax_id', $p_tax_s->tax_id)->first();

            $ren_tax_s ='<option value="'.$ren_s_tax->tax_id.'">'.$ren_s_tax->tax_name . ' (' . $ren_s_tax->tax_amount . ' % )'.'</option>';

            $taxs = DB::table('tax')->where('tax_id', '!=', $ren_s_tax->tax_id)->get();

            foreach ($taxs as $t) {

                $ren_tax_s .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }
        } else {
            $ren_tax_s ='<option value=""></option>';

            $taxs = DB::table('tax')->get();

            foreach ($taxs as $t) {

                $ren_tax_s .='<option value="'.$t->tax_id.'">'.$t->tax_name . ' (' . $t->tax_amount . ' % )'.'</option>';
            }
        }

        // Sell item desc
        $s_desc = ($p->s_description) ? $p->s_description : '';

        // Inventory account
        $inve_true = ($p->inventory_account) ? $p->inventory_account : '';

        $inventory = DB::table('account')->where('ac_id', $inve_true)->first();

        if (isset($inventory->ac_id)) {

            $ren_inventory = '<option value="'.$inventory->ac_id.'">'.$inventory->ac_name .'</option>';

        } else {
            $ren_inventory = '<option value=""></option>';
            $inven = DB::table('account')->where('ac_id',6)->first();
            $ren_inventory .= '<option value="'.$inven->ac_id.'">'.$inven->ac_name.'</option>';
            
        }

        $p_checked = ($p->purchase == 1 ) ? 'checked' : '';
        
        $s_checked = ($p->sell == 1 ) ? 'checked' : '';
        $s_track = ($p->track == 1 ) ? 'checked' : '';

        $ren_pro ='
            <div class="form-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="'.$p->product_id.'">
                            <input type="hidden" name="purchase" value="0" class="purchase">
                            <input type="hidden" name="sell" value="0" class="sell">
                            <input type="hidden" name="track" value="0" class="track">
                            <label for="item_code">Item code</label>
                            <input type="text" name="item_code" id="item_code" class="form-control form-control-sm" value="'.$p->item_code.'" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" name="item_name" id="item_name" class="form-control form-control-sm" value="'.$p->item_name.'">
                        </div>
                    </div>
                    <div class="col-md-5"></div>

                    <div class="col-md-12"><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <fieldset>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input check purchase purchase_c" '.$p_checked.' name="purchase" value="'.$p->purchase.'" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">I Purchase this item</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3 pl-0 h_element_p">
                        <label for="p_unit_price"> <sub>Unit price</sub> </label>
                        <input type="text" name="p_unit_price" id="p_unit_price" class="form-control form-control-sm" value="'.$p_u_p.'">
                    </div>


                    <div class="col-md-3 pl-0 h_element_p">
                        <label for="p_account"><sub>Purchase Account</sub></label>
                        <div class="input-group">
                            <select name="p_account" id="p_account" class="form-control form-control-sm purchase_account" aria-describedby="sizing-addon2">
                                
                                '.$ren_acc_p.'

                                <optgroup label="Expense">
                                    '.$ren_acc_3.'
                                </optgroup>

                                <optgroup label="Assets">
                                    '.$ren_acc_4.'
                                </optgroup>
                                <optgroup label="Liability">
                                    '.$ren_acc_5.'
                                </optgroup>
                                <optgroup label="Equity">
                                    '.$ren_acc_2.'
                                </optgroup>
                                <optgroup label="Income">
                                    '.$ren_acc_1.'
                                </optgroup>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 h_element_p">
                        <label for="p_tax_rate"><sub>Tax Rate</sub></label>
                        <div class="input-group">
                            <select name="p_tax_rate" id="p_tax_rate" class="form-control form-control-sm throw_pacinfo" aria-describedby="sizing-addon2">
                                '.$ren_tax_p.'
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 h_element_p"></div>
                    <div class="col-md-9 pl-0 h_element_p">
                        <label for="p_description"><sub>Purchase Description</sub> <sub class=" text-muted">(for my suppliers)</sub></label>
                        <textarea name="p_description" id="p_description" rows="3" class="form-control form-control-sm">'.$p_desc.'</textarea>
                        
                    </div>
                    <div class="col-md-12"><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <fieldset>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input check sell sell_c" '.$s_checked.'  name="sell" value="'.$p->sell.'" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">I sell this item</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3 pl-0 h_element_s">
                        <label for="s_unit_price"> <sub>Unit price</sub> </label>
                        <input type="text" name="s_unit_price" id="s_unit_price" class="form-control form-control-sm" value="'.$s_u_p.'">
                    </div>


                    <div class="col-md-3 pl-0 h_element_s">
                        <label for="s_account"><sub>Sell Account</sub></label>
                        <div class="input-group">
                            <select name="s_account" id="s_account" class="form-control form-control-sm sell_account" aria-describedby="sizing-addon2">

                                '.$ren_acc_s.'
                                
                                <optgroup label="Income">
                                    '.$ren_acc_s_1.'
                                </optgroup>
                                <optgroup label="Equity">
                                    '.$ren_acc_s_2.'
                                </optgroup>
                                <optgroup label="Liability">
                                    '.$ren_acc_s_3.'
                                </optgroup>
                                <optgroup label="Assets">
                                    '.$ren_acc_s_4.'
                                </optgroup>
                                <optgroup label="Expense">
                                    '.$ren_acc_s_5.'
                                </optgroup>

                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 h_element_s">
                        <label for="s_tax_rate"><sub>Tax Rate</sub></label>
                        <div class="input-group">
                            <select name="s_tax_rate" id="s_tax_rate" class="form-control form-control-sm throw_sacinfo" aria-describedby="sizing-addon2">
                                '.$ren_tax_s.'
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 h_element_s"></div>
                    <div class="col-md-9 pl-0 h_element_s">
                        <label for="s_description"><sub>Sell Description</sub> <sub class=" text-muted">(for my customers)</sub></label>
                        <textarea name="s_description" id="s_description" rows="3" class="form-control form-control-sm">'.$s_desc.'</textarea>
                        
                    </div>
                    <div class="col-md-12"><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <fieldset>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input check track track_c" '.$s_track.' name="track" value="'.$p->track.'" id="customCheck3">
                            <label class="custom-control-label" for="customCheck3">I track this item</label>
                            </div>
                        </fieldset>
                    </div>



                    <div class="col-md-4 pl-0 h_element_t">
                        <label for="inventory_account"><sub>Inventory Asset Account</sub></label>

                        <div class="input-group">
                            <select name="inventory_account" id="inventory_account" class="form-control form-control-sm" aria-describedby="sizing-addon2">
                                '.$ren_inventory.'
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="col-md-5"></div>
                    <div class="col-md-12"><hr></div>
                </div>

            </div>
        
        ';

        echo $ren_pro;


    }

    public function updateproduct (Request $request)
    {
        // dd($request->all());
        $data = array();
        $id = $request->product_id;
        
        $data['item_code'] = $request->item_code;
        $data['item_name'] = $request->item_name;

        if ( $request->purchase > 0) {

            $data['purchase'] = $request->purchase;
            $data['p_unit_price'] = $request->p_unit_price;
            $data['p_account'] = $request->p_account;
            $data['p_tax_rate'] = $request->p_tax_rate;
            $data['p_description'] = $request->p_description;

        } else {

            $data['purchase'] = $request->purchase;
            $data['p_unit_price'] = null;
            $data['p_account'] = null;
            $data['p_tax_rate'] = null;
            $data['p_description'] = null;
        }

        if ($request->sell > 0) {

            $data['sell'] = $request->sell;
            $data['s_unit_price'] = $request->s_unit_price;
            $data['s_account'] = $request->s_account;
            $data['s_tax_rate'] = $request->s_tax_rate;
            $data['s_description'] = $request->s_description;

        } else {
            $data['sell'] = $request->sell;
            $data['s_unit_price'] = null;
            $data['s_account'] = null;
            $data['s_tax_rate'] = null;
            $data['s_description'] = null;
        }

        if ($request->track > 0) {

            $data['track'] = $request->track;
            $data['inventory_account'] = $request->inventory_account;
    
        } else {
            $data['track'] = $request->track;
            $data['inventory_account'] = null;
    
        }

        
        $data['update_by'] = auth()->user()->id;
        $data['update_date'] = date('Y-m-d');
        $data['update_time'] = date('H:i:s');

        DB::table('products')->where('product_id', $id)->update($data);

        session()->flash('success', 'Product Information Update Successfully!');

        return redirect('/cubebooks/info-product/'.$id);
    }


    public static function get_acgrouptype ($id)
    {
        $e = DB::table('account')->where('ac_group', $id)->get();

        return $e;
    }

    // for Edit product
    public static function get_acgrouptype_edit ($id, $not_this_id)
    {
        $e = DB::table('account')
            ->where('ac_group', $id)
            ->where('ac_id', '!=', $not_this_id)
            ->get();

        return $e;
    }


    private function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }

}
