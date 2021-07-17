<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class BankController extends Controller
{
    //

    public function bankCat ()
    {
        $d = array();
        $d["title"] = "Bank Category";
        $d["bank_categorys"] = DB::table('bank_category')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->get();

        return view('pages.bankCat', $d);
    }

    public function savebankCat (Request $request)
    {
        $data = array();
        $data['cat_name'] = $request->cat_name;

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('bank_category')->insert($data);

        session()->flash('success', 'Information Saved Successfully!');

        return redirect()->back();
    }

    public function updateBankCat (Request $request)
    {
        // dd($request->all());
        $data = array();
        $b_c_id = $request->b_c_id;

        $data['cat_name'] = $request->cat_name;

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        DB::table('bank_category')->where('b_c_id', $b_c_id)->update($data);

        session()->flash('success', 'Information update Successfully!');

        return redirect()->back();
    }

    public function bankList ()
    {
        $d['title'] = "Bank List";
        $d["bank_categorys"] = DB::table('bank_category')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->get();

        $d["bank_accounts"] = DB::table('bank_account')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->get();

        return view('pages.bankList', $d);
    }

    public function saveBank (Request $request)
    {
        $data = array();
        $data['b_account_name'] = $request->b_account_name;
        $data['cat_id'] = $request->cat_id;
        $data['b_active'] = $request->b_active;
        $data['b_default'] = $request->b_default;
        $data['payment_method'] = $request->payment_method;
        $data['bank_name'] = $request->bank_name;
        $data['opening_balance'] = $request->opening_balance;
        $data['account_number'] = $request->account_number;
        $data['ob_as_at'] = $request->ob_as_at;
        $data['brance_name'] = $request->brance_name;
        $data['branch_code'] = $request->branch_code;
        $data['description'] = $request->description;
        $data['notes'] = $request->notes;

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['created_by'] = auth()->user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');

        DB::table('bank_account')->insert($data);

        session()->flash('success', 'Information Saved Successfully!');

        return redirect()->back();
    }

    public function catchBankInfo (Request $request)
    {

        $e = $request->b_a_id;

        $b_info = DB::table('bank_account')->where('b_a_id', $e)->first();

        $category = DB::table('bank_category')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->get();

        $b_check = ($b_info->b_active == 1) ? 'checked' : '';

        $b_default = ($b_info->b_default == 1) ? 'checked' : '';

        if ($b_info->cat_id !='') {

            $s_cat = DB::table('bank_category')->where('b_c_id', $b_info->cat_id)->first();

            $b_cat = '<option value="'.$s_cat->b_c_id.'">'.$s_cat->cat_name.'</option>';

            $category = DB::table('bank_category')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->where('b_c_id', '!=', $b_info->cat_id)
                    ->get();

            foreach ($category as $c) {
                $b_cat .= '<option value="'.$c->b_c_id.'">'.$c->cat_name.'</option>';
            }
        } else {
            $b_cat = '<option value="">(None)</option>';
            
            foreach ($category as $c) {
                $b_cat .= '<option value="'.$c->b_c_id.'">'.$c->cat_name.'</option>';
            }
        }

        if ($b_info->payment_method == 1) {
            $p_method = '
                <option value="1">Cash</option>
                <option value="2">Cheque</option>
                <option value="3">Credit Card</option>
            ';
        } else if ($b_info->payment_method == 2) {
            $p_method = '
                <option value="2">Cheque</option>
                <option value="1">Cash</option>
                <option value="3">Credit Card</option>
            ';
        } else if ($b_info->payment_method == 3) {
            $p_method = '
                <option value="3">Credit Card</option>
                <option value="1">Cash</option>
                <option value="2">Cheque</option>
            ';
        }


        $rendata ='
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                        <input type="hidden" value="'.$e.'" name="b_a_id">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Bank Account Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="b_account_name" placeholder="Bank Account Name" value="'.$b_info->b_account_name.'" required>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Category</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm" name="cat_id">'.$b_cat.'</select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-1">

                        <div class="form-check form-check-flat mt-0 ml-5">
                            <label class="form-check-label">
                            <input type="hidden" name="b_active" value="0">
                            <input type="hidden" name="b_default" value="0">
                            <input type="checkbox" class="form-check-input active" value="'.$b_info->b_active.'" name="b_active" '.$b_check.'>
                            Active
                            <i class="input-helper"></i></label>
                        </div>              
                    </div>
                    <div class="form-group row mb-1">

                        <div class="form-check form-check-flat mt-0 ml-5">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input default" value="'.$b_info->b_default.'" name="b_default" '.$b_default.'>
                            Default
                            <i class="input-helper"></i></label>
                        </div>              
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Default Payment Method </label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm" name="payment_method">'.$p_method.'</select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label pr-0 text-right">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="bank_name" value="'.$b_info->bank_name.'" placeholder="Bank Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label pr-0 text-right">Opening Balance</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" name="opening_balance" value="'.$b_info->opening_balance.'" placeholder="Opening Balance" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label pr-0 text-right">Account Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="account_number" value="'.$b_info->account_number.'" placeholder="Account Number" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label pr-0 text-right">Opening Balance as At</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm datepicker" name="ob_as_at" value="' .$b_info->ob_as_at.'" placeholder="Opening Balance as At" required>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Branch Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="brance_name"  value="'.$b_info->brance_name.'"placeholder="Branch Name">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Branch Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="branch_code" value="'.$b_info->branch_code.'"placeholder="Branch Code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control form-control-sm" rows="3">'.$b_info->description.'</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label pr-0 text-right">Notes</label>
                        <div class="col-sm-9">
                            <textarea name="notes" class="form-control form-control-sm" rows="3">'.$b_info->notes.'</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        ';

        echo $rendata;

    }

    public function updateBank (Request $request)
    {
        $data = array();

        $e = $request->b_a_id;
        $data['b_account_name'] = $request->b_account_name;
        $data['cat_id'] = $request->cat_id;
        $data['b_active'] = $request->b_active;
        $data['b_default'] = $request->b_default;
        $data['payment_method'] = $request->payment_method;
        $data['bank_name'] = $request->bank_name;
        $data['opening_balance'] = $request->opening_balance;
        $data['account_number'] = $request->account_number;
        $data['ob_as_at'] = $request->ob_as_at;
        $data['brance_name'] = $request->brance_name;
        $data['branch_code'] = $request->branch_code;
        $data['description'] = $request->description;
        $data['notes'] = $request->notes;

        $data['user_id'] = $this->get_user_id(auth()->user()->id);

        $data['updated_by'] = auth()->user()->id;
        $data['updated_date'] = date('Y-m-d');
        $data['updated_time'] = date('H:i:s');

        DB::table('bank_account')->where('b_a_id', $e)->update($data);

        session()->flash('success', 'Information Update Successfully!');

        return redirect()->back();
    }

    public function deleteBank (Request $request) 
    {
        $e = $request->bank_id;

        $check = DB::table('bank_account')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('b_a_id', $e)
                ->exists();

        $check2 = DB::table('bank_transaction')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('account_id', $e)
                ->exists();

        if ($check) {

            DB::table('bank_account')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('b_a_id', $e)
                ->delete();

            if ($check2) {
            
                DB::table('bank_transaction')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->where('account_id', $e)
                        ->delete();
            }

            echo '1';
        }
    }

    public function bank_transaction(Request $request)
    {
        $data['title'] = 'Bank Transaction';

        
        $data["bank_accounts"] = DB::table('bank_account')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->get();
        if($request->bank_id){
            $data["bank_account_default"] = DB::table('bank_account')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->where('b_a_id', $request->bank_id)
                        ->first();
        }else{
            $data["bank_account_default"] = DB::table('bank_account')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->first();
        }
        

        $data['vats'] = DB::table('tax')->get();

        $data["new_transaction"] = DB::table('bank_transaction')
                        ->leftJoin('tax','bank_transaction.vat', '=', 'tax.tax_id')
                        ->where('bank_transaction.reviewed', false)
                        ->where('bank_transaction.user_id', $this->get_user_id(auth()->user()->id))
                        ->where('bank_transaction.bank_account_id', $data['bank_account_default']->b_a_id)
                        ->get();
        
        $data["reviewed_transaction"] = DB::table('bank_transaction')
                        ->leftJoin('tax','bank_transaction.vat', '=', 'tax.tax_id')
                        ->where('bank_transaction.reviewed', true)
                        ->where('bank_transaction.user_id', $this->get_user_id(auth()->user()->id))
                        ->where('bank_transaction.bank_account_id', $data['bank_account_default']->b_a_id)
                        ->get();

        // return response()->json($data);
        // exit;
        return view('pages.bank_transaction', $data);
    }

    public function getBankTansactionSelection(Request $request){
        $type = $request->type;
        $results = array();
        switch($type){
            case 'account': 
                $accounts = DB::table('account')
                    ->leftJoin('account_type', 'account.ac_type', '=', 'account_type.type_id')
                    ->leftJoin('tax', 'account.tax_account', '=', 'tax.tax_id')
                    ->get();
                foreach($accounts as $account){
                   
                    $results[$account->type_id]['name'] = $account->type_name;
                    $results[$account->type_id]['selections'][] = array(
                        'id' => $account->ac_id,
                        'name' => $account->ac_name
                    );
                }

                $results['grouped'] = true;
            break; 
            case 'customer': 
                $customers = DB::table('customers')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->get();

                foreach($customers as $customer){
                    $results['options'][] = array(
                        'id' => $customer->cust_id,
                        'name' => $customer->display_name
                    );
                }

                $results['grouped'] = false;
            break;
            case 'supplier':
                $suppliers = DB::table('suppliers')
                                ->where('user_id', $this->get_user_id(auth()->user()->id))
                                ->get();

                foreach($suppliers as $supplier){
                    $results['options'][] = array(
                        'id' => $supplier->id,
                        'name' => $supplier->display_name
                    );
                }

                $results['grouped'] = false;
            break;
            case 'transfer':
                $bank_accounts = DB::table('bank_account')
                                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                                    ->get();

                foreach($bank_accounts as $bank){
                    $results['options'][] = array(
                        'id' => $bank->b_a_id,
                        'name' => $bank->b_account_name
                    );
                }

                $results['grouped'] = false;

            break;
            case 'vat': 
                $vats = DB::table('tax')->get();
                
                foreach($vats as $vat){
                    $results['options'][] = array(
                        'id' => $vat->tax_id,
                        'name' => $vat->tax_name
                    );
                }

                $results['grouped'] = false;
            break;
        }

        return response()->json($results);   
    }
    // UPload CSV
    public function savebankcsv(Request $request)
    {
        // $file = public_path('file/test.csv');
        $file = $request->csv_file;

        $bank_account = $request->bank_account;
        $bank_type = $request->bank_type;
        $user_id = $this->get_user_id(auth()->user()->id);


        $importDataArr = $this->csvToArray($file);

        if ($importDataArr == false) {

            session()->flash('err', 'Your CSV file not mach in our upload system, Please read first CSV upload documention');

            return redirect()->back();
        } else {

            $validator = Validator::make($request->all(), [
                'bank_account' => ['required'],
                'csv_file' => ['required'],
            ]);

            if($validator->fails()) {

                session()->flash('err', 'Please select your bank account, before you upload your CSV File');
                return redirect()->back();
            } 
            
            foreach($importDataArr as $importdata){
                $insertArr = array();
                if($importdata['Amount'] != ""){
                    $insertArr['user_id'] = $user_id;
                    $insertArr['bank_account_id'] = $bank_account;
                    $insertArr['description'] = $importdata['Description'];
                    $insertArr['date'] = $importdata['Date'];
                    if($importdata['Amount'] > 0){
                        $insertArr['received'] = abs($importdata['Amount']);
                    }else{
                        $insertArr['spent'] = abs($importdata['Amount']);
                    }
                    DB::table('bank_transaction')->insert($insertArr);
                }
            }

            session()->flash('success', 'Your CSV file upload successfully');
            return redirect()->back();
        }
   
    }

    public function deleteBankTransaction (Request $request)
    {
        $trans_id = $request->trans_id;

        $check = DB::table('bank_transaction')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('bt_id', $trans_id)
                ->exists();

        if ($check) {

            DB::table('bank_transaction')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('bt_id', $trans_id)
                ->delete();

            return response()->json(array('success'=>true));
        }
    }

    public function deleteManyBankTransaction (Request $request)
    {
        $trans_ids = $request->trans_ids;

        if($trans_ids){
            foreach($trans_ids as $trans_id){
                $check = DB::table('bank_transaction')
                            ->where('user_id', $this->get_user_id(auth()->user()->id))
                            ->where('bt_id', $trans_id)
                            ->exists();
                if ($check) {
                    DB::table('bank_transaction')
                        ->where('user_id', $this->get_user_id(auth()->user()->id))
                        ->where('bt_id', $trans_id)
                        ->delete();
                }
            }
            return response()->json(array('success'=>true));
        }else{
            return response()->json(array('success'=>false, 'msg' => 'No selected transaction'));
        }
    }

    public function searchBankTransaction (Request $request)
    {
        $e = $request->bank_id;


        $check = DB::table('bank_account')
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('b_a_id', $e)
                ->exists();

        if ($check) {

            $bt = DB::table('bank_transaction')
                ->leftJoin('bank_account', 'bank_transaction.account_id', '=', 'bank_account.b_a_id')
                ->select(
                    'bank_transaction.bt_id as bt_id',
                    'bank_transaction.date as t_date',
                    'bank_transaction.bank_type as bank_type',
                    'bank_transaction.description as t_description',
                    'bank_transaction.balance as balance',
                    'bank_transaction.amount as amount',
                    'bank_transaction.remarks as remarks',
                    'bank_account.b_account_name as b_account_name'
                )
                ->where('bank_transaction.user_id', $this->get_user_id(auth()->user()->id))
                ->where('bank_transaction.account_id', $e)
                ->get();

            $ren_data = '';

            foreach ($bt as $bt) {
                $ren_data .='
                    <tr>
                        <td>'.$bt->t_date.'</td>
                        <td>'.$bt->bank_type.'</td>
                        <td>'.$bt->b_account_name.'</td>
                        <td>'.$bt->t_description.'</td>
                        <td>R '.$bt->balance.'</td>
                        <td>R '.$bt->amount.'</td>
                        <td>'.$bt->remarks.'</td>          
                        <td class="text-center px_5">
                            <button 
                                type="button" 
                                class="btn btn-icons btn-rounded btn-danger delete"
                                value="'.$bt->bt_id.'"
                                >
                                <i class="mdi mdi-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }

            echo $ren_data;
        } else {
            echo '<tr><td colspan=\'8\' class="text-center text-danger"><b> Nothing Found.</b></td></tr>';
        }
    }


    public function saveTransactions (Request $request)
    {
        //dd($request->all());

        $trans_ids = $request->trans_id;
        $dates = $request->date;
        $descriptions = $request->description;
        $types = $request->type;
        $selections = $request->selection;
        $references = $request->reference;
        $vats = $request->vat;
        $spents = $request->spent;
        $received = $request->received;
        $reconcile = $request->reconcile;

        $data = array();
        $data['user_id'] = $this->get_user_id(auth()->user()->id);
        $data['bank_account_id'] = $request->bank_account_id;

        for ($i = 0; $i < count($dates); $i ++) {
            if($spents[$i] != NULL || $received[$i]){
                $data['date'] = $dates[$i];
                $data['description'] = $descriptions[$i];
                $data['type'] = $types[$i];
                $data['selection_id'] = $selections[$i];
                $data['reference'] = $references[$i];
                $data['vat'] = !isset($vats[$i]) ? null : $vats[$i];
                $data['spent'] = $spents[$i];
                $data['received'] = $received[$i];
                $data['reconcile'] = isset($reconcile[$i]) ? 1 : 0;

                $trans_id = !isset($trans_ids[$i]) ? null : $trans_ids[$i];
                if($trans_id != null){
                    DB::table('bank_transaction')->where('bt_id', $trans_id)->update($data);
                }else{
                    DB::table('bank_transaction')->insert($data);
                }
                
            }
        }
        session()->flash('success', 'Your data save successfully');
        return redirect()->back();
    }

    public function markSelectedAsReviewed(Request $request){
        $trans_ids = $request->trans_ids;

        if($trans_ids){
            foreach($trans_ids as $id){
                DB::table('bank_transaction')->where('bt_id', $id)->update(['reviewed' => 1]);
            }
            return response()->json(array('success'=>true));
        }else{
            return response()->json(array('success'=>false, 'msg' => 'No selected transaction'));
        }
    }

    public function markAllAsReviewed(Request $request){
        $bank_account_id = $request->bank_account_id;

        DB::table('bank_transaction')
                ->where('bank_account_id', $bank_account_id)
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('reviewed', '!=', 1)
                ->update(['reviewed' => 1]);

        return response()->json(array('success'=>true));
    }

    public function markSelectedAsUnReviewed(Request $request){
        $trans_ids = $request->trans_ids;

        if($trans_ids){
            foreach($trans_ids as $id){
                DB::table('bank_transaction')->where('bt_id', $id)->update(['reviewed' => 0]);
            }
            return response()->json(array('success'=>true));
        }else{
            return response()->json(array('success'=>false, 'msg' => 'No selected transaction'));
        }
    }

    public function markAllAsUnReviewed(Request $request){
        $bank_account_id = $request->bank_account_id;

        DB::table('bank_transaction')
                ->where('bank_account_id', $bank_account_id)
                ->where('user_id', $this->get_user_id(auth()->user()->id))
                ->where('reviewed', '!=', 0)
                ->update(['reviewed' => 0]);

        return response()->json(array('success'=>true));
    }
    // CSV file Upload 
    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
        {
            return false;
        }
        

        $header = null;
        $data = array();
        
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header) 
                {
                    $header = $row;
                } else {
                    if (count($header) == count($row)) {
                        $data[] = array_combine($header, $row);
                    } else {
                        return false;
                    }
                    
                }
            }
            fclose($handle);
        }

        return $data;
    }



    private function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }
}
