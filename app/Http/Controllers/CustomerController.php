<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use Response;
use Auth;
use DB;
class CustomerController extends Controller
{
    public function manageCustomer() 
    {
        $data = array();
        $data["title"] = "Customer Management";
        $data["all"] = DB::table('customers')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->get();
        $data["active"] = DB::table('customers')
                        ->where('active_status', 1)
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->get();
        $data["inactive"] = DB::table('customers')
                        ->where('active_status', 0)
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->get();

        return view('pages.customers', $data);
    }
    
    public function getCust(Request $request)
    {
        $columns = array(
            0 =>'cust_id',
            1=> 'display_name',
            2=> 'email',
            3=> 'phone',
            4=> 'mobile',
            5=> 'address',
            5=> 'opening_balance',
            6=> 'action'
        );
        
        $totalData = Customer::where('user_id',Auth::guard('web')->user()->id)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
       
        if(empty($request->input('search.value')))
        {
            $posts = Customer::where('user_id',Auth::guard('web')->user()->id)->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            $totalFiltered =  Customer::where('user_id',Auth::guard('web')->user()->id)->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Customer::where('user_id',Auth::guard('web')->user()->id)->where('display_name', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            $totalFiltered = Customer::where('user_id',Auth::guard('web')->user()->id)->where('display_name', 'like', "%{$search}%")
                           ->orwhere('email', 'like', "%{$search}%")
                           ->count();
        }
        $data = array();

        if($posts){
            foreach($posts as $r)
            {     
                $nestedData['cust_id'] = $r->cust_id;
                $nestedData['display_name'] = $r->display_name;
                $nestedData['email'] = $r->email;
                $nestedData['phone'] = $r->phone;
                $nestedData['mobile'] = $r->mobile;
                $nestedData['address'] = $r->b_street.','.$r->b_city.','.$r->b_state.','.$r->b_postal.','.$r->b_country;
                $nestedData['opening_balance'] = $r->opening_balance;
                $nestedData['action']= '<a href="#" style="color:red;" class="delete-modal btn btn-xs" '
                            . 'data-delcids="'.$r->cust_id.'" data-cname="'.$r->display_name.'"><i class="fa fa-trash"></i></a>';
                $data[] = $nestedData;
            }
        }     
        $json_data = array(
            "draw"	      => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"	      => $data
        );
        echo json_encode($json_data);    
    }

    public function saveCustomer(Request $request)
    {
        // $customer= new Customer;

        // $customer->first_name = $request->first_name;
        // $customer->user_id = Auth::guard('web')->user()->id;
        // $customer->last_name = $request->last_name;
        // $customer->display_name = $request->display_name;
        // $customer->company = $request->company;
        // $customer->email = $request->email;
        // $customer->phone = $request->phone;
        
        // $customer->mobile = $request->mobile;
        // $customer->fax = $request->fax;
        // $customer->other = $request->other;
        // $customer->website = $request->website;
        // $customer->b_street = $request->b_street;
        // $customer->b_city = $request->b_city;
        // $customer->b_state = $request->b_state;
        // $customer->b_postal = $request->b_postal;
        // $customer->b_country = $request->b_country;
        // $customer->c_street = $request->c_street;
        // $customer->c_city = $request->c_city;
        // $customer->c_state = $request->c_state;
        // $customer->c_postal = $request->c_postal;
        // $customer->c_country = $request->c_country;
        
        // $customer->note = $request->note;
        // $customer->vat_reg_no = $request->vat_reg_no;
        // $customer->payment_method = $request->payment_method;
        // $customer->delivery_method = $request->delivery_method;
        // $customer->terms = $request->terms;
        // $customer->opening_balance = $request->opening_balance;
        
        // $customer->note = $request->note;
        // $customer->vat_reg_no = $request->vat_reg_no;
        // $customer->payment_method = $request->payment_method;
        // $customer->delivery_method = $request->delivery_method;
        // $customer->terms = $request->terms;
        // $customer->opening_balance = $request->opening_balance;
        // $customer->as_of_date = $request->as_of_date;
        
        // $image=$request->file('att');
        // if($image)
        // {
        //     $image_name=str_random(3).$request->display_name;
        //     $ext=strtolower($image->getClientOriginalExtension());
        //     $image_full_name=$image_name.'.'.$ext;
        //     $upload_path='public/files/';
        //     $file_url=$upload_path.$image_full_name;
        //     $success=$image->move($upload_path,$image_full_name);
        //     if($success)
        //     {
        //         $customer->att = $file_url;
        //     }
        // }
        // $saved = $customer->save();
        
        // if(!$saved)
        // {
        //     $notification = array(
        //         'message' => 'Failed to add Customer',
        //         'type' => 'error'
        //     );
        // }
        // $notification = array(
        //     'message' => 'Customer Added Successfully',
        //     'type' => 'success'
        // );
        // return Response::json($notification);

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['contact_person'] = $request->contact_person;

        $data['display_name'] = $request->display_name;
        $data['company'] = $request->company;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['mobile'] = $request->mobile;
        $data['fax'] = $request->fax;
        $data['other'] = $request->other;
        $data['website'] = $request->website;
        $data['b_street'] = $request->b_street;
        $data['b_city'] = $request->b_city;
        $data['b_state'] = $request->b_state;
        $data['b_postal'] = $request->b_postal;
        $data['b_country'] = $request->b_country;
        $data['c_street'] = $request->c_street;
        $data['c_city'] = $request->c_city;
        $data['c_state'] = $request->c_state;
        $data['c_postal'] = $request->c_postal;
        $data['c_country'] = $request->c_country;

        $data['note'] = $request->note;
        $data['vat_reg_no'] = $request->vat_reg_no;
        $data['payment_method'] = $request->payment_method;
        $data['delivery_method'] = $request->delivery_method;
        $data['terms'] = $request->terms;
        $data['opening_balance'] = $request->opening_balance;
        $data['as_of_date'] = $request->as_of_date;

        if ($_FILES['att']['name'] !== '') {

            $this->validate($request, [

                'att' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            $files = $request->file('att');

            $filename = $files->getClientOriginalName();

            $picture = date('His') . $filename;

            $image_url = 'public/files/' . $picture;

            $destinationPath = base_path() . '/public/files';

            $success = $files->move($destinationPath, $picture);

            if ($success) {

                $data['att'] = $image_url;
            } 
        }

        $customer = DB::table('customers')->insert($data);

        session()->flash('success', 'Information Save Successfully!');

        return redirect()->back()->with(compact('customer'));
    }


    public function customerInfo (Request $request)
    {
        $c_id = $request->c_id;

        $customers = DB::table('customers')->where('cust_id', $c_id)->first();

        // ============================= Payment Method Start ============================= //
            if ($customers->payment_method == 1) {            
                $payment_method ='
                    <option value="1">Cash</option>
                    <option value="2">Check</option>
                    <option value="3">Credit</option>
                    <option value="4">Debit</option>
                ';                                                    
            } elseif ($customers->payment_method == 2) {
                $payment_method ='
                    <option value="2">Check</option>
                    <option value="1">Cash</option>
                    <option value="3">Credit</option>
                    <option value="4">Debit</option>
                ';
            } elseif ($customers->payment_method == 3) {
                $payment_method ='
                    <option value="3">Credit</option>
                    <option value="1">Cash</option>
                    <option value="2">Check</option>
                    <option value="4">Debit</option>
                ';
            } elseif ($customers->payment_method == 4) {
                $payment_method ='
                    <option value="4">Debit</option>
                    <option value="1">Cash</option>
                    <option value="2">Check</option>
                    <option value="3">Credit</option>
                ';
            }
        // ============================= Payment Method End ============================== //

        // ============================= Delivery Method Start ============================= //
            if ($customers->delivery_method == '') {
                $delivery_method ='
                    <option value="">None</option>
                    <option value="1">Print Later</option>
                    <option value="2">Send Later</option>
                ';
            } else if ($customers->delivery_method == 1) {
                $delivery_method ='
                    <option value="1">Print Later</option>
                    <option value="2">Send Later</option>
                ';
            } else if ($customers->delivery_method == 2) {
                $delivery_method ='
                    <option value="2">Send Later</option>
                    <option value="1">Print Later</option>
                ';
            }
        // ============================= Delivery Method End ============================== //

        // ============================= Terms Start ============================= //
            if ($customers->terms == 1) {
                $terms ='
                    <option value="1">Due on Receipt</option>
                    <option value="2">Net 15</option>
                    <option value="3">Net 30</option>
                    <option value="4">Net 60</option>
                ';
            } else if ($customers->terms == 2) {
                $terms ='
                    <option value="2">Net 15</option>
                    <option value="1">Due on Receipt</option>
                    <option value="3">Net 30</option>
                    <option value="4">Net 60</option>
                ';
            } else if ($customers->terms == 3) {
                $terms ='
                    <option value="3">Net 30</option>
                    <option value="1">Due on Receipt</option>
                    <option value="2">Net 15</option>
                    <option value="4">Net 60</option>
                ';
            } else if ($customers->terms == 4) {
                $terms ='
                    <option value="4">Net 60</option>
                    <option value="1">Due on Receipt</option>
                    <option value="2">Net 15</option>
                    <option value="3">Net 30</option>
                ';
            }
        // ============================= Terms End ============================== //
                                                    

        $ren_data ='
            <input type="hidden" name="cust_id" value="'.$customers->cust_id.'" />
            <div class="row">
                <div class="col-md-4">
                    <label for="timesheetinput2">Company</label>
                    <div class="position-relative has-icon-left">
                        <input type="text" name="company" class="form-control" placeholder="Company Name" value="'.$customers->company.'">
                        <div class="form-control-position">
                            <i class="fa fa-briefcase"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="text" name="display_name" class="form-control" required value="'.$customers->display_name.'">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" value="'.$customers->contact_person.'">
                    </div>
                </div>
                
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="'.$customers->mobile.'">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="'.$customers->email.'">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="'.$customers->phone.'">
                    </div>
                </div>   
                
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fax</label>
                        <input type="text" name="fax" class="form-control"  placeholder="Fax" value="'.$customers->fax.'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Other</label>
                        <input type="text" name="other" class="form-control" placeholder="Other" value="'.$customers->other.'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" name="website" class="form-control" placeholder="Website" value="'.$customers->website.'">
                    </div>
                </div>                            
            </div>  
                                            
            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" role="tab" aria-selected="true">Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12" role="tab" aria-selected="false">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13" role="tab" aria-selected="false">Vat Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14" href="#tab14" role="tab" aria-selected="false">Payment & Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab15" data-toggle="tab" aria-controls="tab15" href="#tab15" role="tab" aria-selected="false">Attachments</a>
                        </li>
                    </ul>

                    <div class="tab-content px-1 pt-1">

                        <div class="tab-pane active" id="tab11" role="tabpanel" aria-labelledby="address">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Billing Address</label>
                                                <input type="text" class="form-control" name="b_street" id="b_street_edit" placeholder="Street" value="'.$customers->b_street.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="b_city" id="b_city_edit" placeholder="City/Town" value="'.$customers->b_city.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="b_state" id="b_state_edit" placeholder="State/Province"  value="'.$customers->b_state.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="b_postal" id="b_postal_edit" placeholder="Postal Code"  value="'.$customers->b_postal.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="b_country" id="b_country_edit" placeholder="Country"  value="'.$customers->b_country.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shipping Address</label> <label> (Same as Billing Address) 
                                                    <input type="checkbox" id="shipadd_edit" name="shipadd">
                                                </label>
                                                
                                                <input type="text" class="form-control" name="c_street" id="c_street_edit" placeholder="Street" value="'.$customers->c_street.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_city" id="c_city_edit" placeholder="City/Town" value="'.$customers->c_city.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_state" id="c_state_edit" placeholder="State/Province" value="'.$customers->c_state.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_postal" id="c_postal_edit" placeholder="Postal Code" value="'.$customers->c_postal.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_country" id="c_country_edit" placeholder="Country" value="'.$customers->c_country.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab12" role="tabpanel" aria-labelledby="note">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" name="note" rows="8">'.$customers->note.'</textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane" id="tab13" role="tabpanel" aria-labelledby="vat_info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>VAT Reg. No.</label>
                                        <input type="text" name="vat_reg_no" class="form-control" value="'.$customers->vat_reg_no.'">
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane" id="tab14" role="tabpanel" aria-labelledby="payment">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Preferred Payment Method</label>
                                                <select class="select2 form-control" name="payment_method">
                                                   '.$payment_method.'
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Preferred Delivery Method</label>
                                                <select class="select2 form-control" name="delivery_method">
                                                    '.$delivery_method.'
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Terms</label>
                                                <select class="select2 form-control" name="terms">
                                                    '.$terms.'
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Opening Balance</label>
                                                <input type="text" name="opening_balance" value="'.$customers->opening_balance.'" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>As Of</label>
                                                <input type="date" name="as_of_date" class="form-control" value="'.$customers->as_of_date.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane" id="tab15" role="tabpanel" aria-labelledby="attachments">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="icon-anchor"></i> Attachments</label>
                                        <input type="file" class="form-control" name="att" placeholder="Country">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>                   
            </div> 
        ';
        echo $ren_data;
    }

    public function updateCustomer (Request $request)
    {
        $data = array();

        $data['user_id'] = Auth::guard('web')->user()->id;

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['display_name'] = $request->display_name;
        $data['company'] = $request->company;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['mobile'] = $request->mobile;
        $data['fax'] = $request->fax;
        $data['other'] = $request->other;
        $data['website'] = $request->website;
        $data['b_street'] = $request->b_street;
        $data['b_city'] = $request->b_city;
        $data['b_state'] = $request->b_state;
        $data['b_postal'] = $request->b_postal;
        $data['b_country'] = $request->b_country;
        $data['c_street'] = $request->c_street;
        $data['c_city'] = $request->c_city;
        $data['c_state'] = $request->c_state;
        $data['c_postal'] = $request->c_postal;
        $data['c_country'] = $request->c_country;

        $data['note'] = $request->note;
        $data['vat_reg_no'] = $request->vat_reg_no;
        $data['payment_method'] = $request->payment_method;
        $data['delivery_method'] = $request->delivery_method;
        $data['terms'] = $request->terms;
        $data['opening_balance'] = $request->opening_balance;
        $data['as_of_date'] = $request->as_of_date;

        if ($_FILES['att']['name'] !== '') {

            $this->validate($request, [

                'att' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            $files = $request->file('att');

            $filename = $files->getClientOriginalName();

            $picture = date('His') . $filename;

            $image_url = 'public/files/' . $picture;

            $destinationPath = base_path() . '/public/files';

            $success = $files->move($destinationPath, $picture);

            if ($success) {

                $data['att'] = $image_url;
            }
        }

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        $cust_id = $request->cust_id; 

        DB::table('customers')->where('cust_id', $cust_id)->update($data);

        session()->flash('success', 'Information Update Successfully!');

        return redirect('/cubebooks/customers');
    }

    public function inactiveCustomer (Request $request)
    {
        $e = $request->cust_id;
        
        $data = array();

        $data['active_status'] = 0;

        DB::table('customers')->where('cust_id', $e)->update($data);

        // DB::table('customers')->where('cust_id', $e)->delete();

        echo '1';
    }

    public function inactiveCustomers () 
    {
        $ia = array();
        $ia["title"] = "Inactive Customers";
        $ia["customers"] = DB::table('customers')
                        ->where('active_status', 0)
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->get();


        return view('pages.inactive_customer', $ia);
    }

    public function activeCustomer (Request $request)
    {
        $e = $request->cust_id;

        $a = array();

        $a['active_status'] = 1;

        DB::table('customers')->where('cust_id', $e)->update($a);

        echo '1';
    }
    
    private function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }

    
    // public function delCustomer(Request $request)
    // {
    //     Customer::find($request->delcid)->delete();

    //     $notdel = array(
    //         'message' => 'Customer Deleted Successfully',
    //         'type' => 'error'
    //     ); 
    //     return Response::json($notdel);
    // }

    
}
