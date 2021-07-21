<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Session;
use App\Account;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ,
            'company_name' => ['required', 'string', 'max:255']
            ,
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        dd('dsds');
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm ()
    {
        $data = array();
        $data['title'] = 'Sign Up';
        return view('auth.register', $data);
    }
    protected function register(Request $request)
    {
        $this->validator($request->all());
        $code = substr(str_shuffle("0123456789"), 0, 5);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->verification_code = $code;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->register_date = date('Y-m-d');

        $company_info['display_name'] = $request->company_name;

        $company = DB::table('company_info')->insert($company_info);
       
        
        $user->save();

        // $u_user = User::findOrFail($user->id);
        // $d['user_id'] = $user->id;
        // $u_user->update($d);
        $inv = array();
        // $inv['template'] = 1;
        $inv['inv_name'] = 'INV';
        $inv['inv_code'] = 00;
        // $inv['default_tax_rate'] = 0.00;

        $inv['user_id'] = $user->id;
        $inv['updated_by'] = $user->id;
        $inv['updated_date'] = date('Y-m-d');
        $inv['updated_time'] = date('H:i:s');

        DB::table('inv_settings')->insert($inv);
        $accounts = DB::table('account')->get();
        
        foreach ($accounts as $key => $value) {
            $account = new Account();
            $account->user_id = $user->id;
            $account->ac_name = $value->ac_name;
            $account->ac_number = $value->ac_number;
            $account->ac_type = $value->ac_type;
            $account->ac_group = $value->ac_group;
            $account->tax_account = $value->tax_account;
            $account->description = $value->description;
            $account->created_by = $user->id;
            $account->created_date = date('d-m-Y');
            $account->created_time = date('H:i:s');
            $account->save();
        }



        // $message =urlencode('Hello '. $request->name.'! Your Cubeapps verification code is '.$code);
        // $url='http://www.winsms.co.za/api/batchmessage.asp?user=info@micleaners.co.za&password=Jordyn16$&message='.$message.'&Numbers='.$request->phone.';';
        // $fp = fopen($url, 'r');
        // while(!feof($fp))
        // {
        //     $line = fgets($fp, 4000);
        //     if($line){
        //         // $u_user->update($d);
        //         session()->flash('success', 'A verification code has been sent to '.$request->phone);
        //         return Redirect::to(URL::temporarySignedRoute('verify', now()->addMinutes(2), ['user' => $user->id,'phone' => $user->phone]));

        //     }else {
        //         session()->flash('error', 'There was a problem while registered');
        //         return back();
        //     }
        // }
        // fclose($fp);

        return route('/');
        
    }
}
