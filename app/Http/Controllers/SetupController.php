<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setup;
use Auth;
use Response;
use App\EmailTemplate;
use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{
    
    
    public function manageSetup() 
    {
        $data = array();
        $data["title"] = "Settings";
        $data["setups"] = Setup::find(1);
        return view('pages.setup.tax', $data);
    }

    public function tax ()
    {
        $taxs = DB::table('tax')->get();
        return view('pages.tax', compact('taxs'));
    }

    public function taxSave (Request $request)
    {
        // dd($request->all());
        // date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['tax_name'] = $request->tax_name;
        $data['tax_amount'] = $request->tax_amount;

        $data['created_by'] = auth()->user()->id;
        // $data['created_time'] = date('H:i:s');

        DB::table('tax')->insert($data);

        session()->flash('success', 'Tax Information Saved Successfully!');

        return redirect('/cubebooks/tax');
    }
    
    public function invSetup ()
    {

        $last_inv = DB::table('invoices')
                    ->where('user_id', $this->get_user_id(auth()->user()->id))
                    ->orderBy('invoice_id', 'DESC')
                    ->first();

        $inv = DB::table('inv_settings')
                ->leftJoin('users', 'inv_settings.updated_by', '=', 'users.id')
                ->where('inv_settings.user_id', $this->get_user_id(auth()->user()->id))
                ->first();

        $e['tax_rates'] = DB::table('tax')->get();

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

        return view('pages.inv_setup', $e);
    }   

    public function updateInv (Request $request)
    {
        $id = $request->inv_id;
        $inv = array();
        if (isset($request->template)) {
            $inv['template'] = $request->template;
        }else{
            $inv['inv_name'] = $request->inv_name;
            $inv['inv_code'] = $request->inv_code;
            $inv['default_tax_rate'] = $request->tax_account;
            $inv['default_account_type'] = $request->ac_type;
            $inv['note'] = $request->note;
            $inv['user_id'] = $this->get_user_id(auth()->user()->id);
            $inv['updated_by'] = $this->get_user_id(auth()->user()->id);
            $inv['updated_date'] = date('Y-m-d');
            $inv['updated_time'] = date('H:i:s');
        }
        


        if (isset($id)) {

            DB::table('inv_settings')->where('inv_id', $id)->update($inv);
            session()->flash('success', 'Information Update Successfully!');
            return redirect()->back();

        } else {
            DB::table('inv_settings')->insert($inv);
            session()->flash('success', 'Information Update Successfully!');
            return redirect()->back();
        }


    }

    public function companySetup ()
    {

        $c['com'] = $com = DB::table('company_info')->where('user_id', $this->get_user_id(auth()->user()->id))->first();

        if (isset($com)) {


            $c['pc'] = DB::table('countries')->where('id', $com->postal_country)->first();
            $c['ps'] = DB::table('countries')->where('id', $com->phy_country)->first();

        } else {
            $c['pc'] = '';
            $c['ps'] = '';
        }

        $c['countries1'] = DB::table('countries')->get();
        $c['countries'] = DB::table('countries')->get();

        return view('pages.company_setup', $c);
    }

    public function CatchInvNumber (Request $request)
    {
        $e = $request->val;

        $inv = DB::table('invoices')
            ->where('invoice_code', $e)
            ->where('user_id', $this->get_user_id(auth()->user()->id))
            ->exists();

        $ren = '';

        if ($inv) {

            $ren = '1';
        } else {
            $ren = '2';
        }

        echo $ren;
    }

    public function updateCom (Request $request)
    {
        // dd($request->all());
        $c = array();

        $c_id = $request->com_id;

        $c['display_name'] = $request->display_name;
        $c['trading_name'] = $request->trading_name;

        if ($_FILES['com_logo']['name'] !== '') {

            $this->validate($request, [

                'com_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            $files = $request->file('com_logo');

            $filename = $files->getClientOriginalName();

            $picture = date('His') . $filename;

            $image_url = 'public/img/company_img/' . $picture;

            $destinationPath = base_path() . '/public/img/company_img';

            $success = $files->move($destinationPath, $picture);

            if ($success) {

                $c['com_logo'] = $image_url;
            }
        }

        $c['business_line'] = $request->business_line;
        $c['organisation_type'] = $request->organisation_type;
        $c['business_reg_number'] = $request->business_reg_number;
        $c['organisation_description'] = $request->organisation_description;
        $c['postal_address'] = $request->postal_address;
        $c['postal_city'] = $request->postal_city;
        $c['postal_stase'] = $request->postal_stase;
        $c['postal_code'] = $request->postal_code;
        $c['postal_country'] = $request->postal_country;
        $c['postal_attention'] = $request->postal_attention;
        $c['phy_address'] = $request->phy_address;
        $c['phy_city'] = $request->phy_city;
        $c['phy_stase'] = $request->phy_stase;
        $c['phy_code'] = $request->phy_code;
        $c['phy_country'] = $request->phy_country;
        $c['phy_attention'] = $request->phy_attention;
        $c['telephone'] = $request->telephone;
        $c['com_email'] = $request->com_email;
        $c['com_website'] = $request->com_website;
        $c['vat_no'] = $request->vat_no;

        $c['user_id'] = $this->get_user_id(auth()->user()->id);

        if (isset($c_id)) {
            DB::table('company_info')->where('com_id', $c_id)->update($c);
            session()->flash('success', 'Information Save Successfully!');
            return redirect()->back();

        } else {
            DB::table('company_info')->insert($c);

            $defaultemailtemplates = DB::table('email_templates_default')->get();
            foreach ($defaultemailtemplates as $defaulttemplate) {
                $template = new EmailTemplate();
                $template->title = $defaulttemplate->title;
                $template->subject = $defaulttemplate->subject;
                $template->sender = $defaulttemplate->sender;
                $template->body = $defaulttemplate->body;
                $template->attach_invoice = $defaulttemplate->attach_invoice;
                $template->embed_invoice = $defaulttemplate->embed_invoice;
                $template->save();
            }

            session()->flash('success', 'Information Save Successfully!');
            return redirect()->back();
        }


    }


    // public function upInvstrt(Request $request)
    // {
    //     $update = Setup::find(1);
    //     $update->invoice_start = $request->invoice_start;
    //     $update->save();

    //     $notification = array(
    //         'message' => 'Invoice Start Changed Successfully',
    //         'type' => 'warning'
    //     );

    //     return Response::json($notification);
    // }
    
    // public function upTax(Request $request) 
    // {
    //     $update = Setup::find(1);
    //     $update->tax = $request->tax;
    //     $update->save();
    //     $notification = array(
    //         'message' => 'Tax Changed Successfully',
    //         'type' => 'warning'
    //     );
    //     return Response::json($notification);
    // }

    public function smtpSetup ()
    {
        $smpt = DB::table('smtp_settings')->first();
        return view('pages.smtp_setup', compact('smpt'));
    }

    public function updateSmtp (Request $request)
    {
        $d['smtp_host'] = $request->smtp_host;
        $d['smtp_port'] = $request->smtp_port;
        $d['smtp_username'] = $request->smtp_username;
        $d['smtp_password'] = $request->smtp_password;
        $d['from_email'] = $request->from_email;
        $d['from_name'] = $request->from_name;

        $path = base_path('.env');

        if (file_exists($path)) {
            
            file_put_contents($path, str_replace(
                'MAIL_USERNAME='.config('mail.username'), 'MAIL_USERNAME='.$request->smtp_username, file_get_contents($path)
            ));
            
            file_put_contents($path, str_replace(
                'MAIL_HOST='.config('mail.host'), 'MAIL_HOST='.$request->smtp_host, file_get_contents($path)
            ));
            
            
            file_put_contents($path, str_replace(
                'MAIL_PASSWORD='.config('mail.password'), 'MAIL_PASSWORD='.$request->smtp_password, file_get_contents($path)
            ));
            
            file_put_contents($path, str_replace(
                'MAIL_PORT='.config('mail.port'), 'MAIL_PORT='.$request->smtp_port, file_get_contents($path)
            ));
        }
        
        
        DB::table('smtp_settings')->where('smtp_id', 1)->update($d);
        session()->flash('success', 'Information update Successfully!');
        return redirect()->back();

    }

    public function checkIssmtp($status){

        $d['is_smtp'] = $status;

        DB::table('smtp_settings')->where('smtp_id', 1)->update($d);

        session()->flash('success', 'Information Update Successfully!');
        return redirect()->back();
    }



    private function get_user_id($id)
    {
        $u_id = DB::table('users')->where('id', $id)->first();

        $user_id = $u_id->id;

        return $user_id;
    }
}
