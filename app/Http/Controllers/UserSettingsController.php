<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserSettingsController extends Controller
{
    //
    public function userProfile ()
    {
        $data = array();

        $data["title"] = "User Settings";

        $data["user"] = DB::table('users')->where('id', auth()->user()->id)->first();

        return view('pages.user_settings', $data);
    }

    public function updateUser (Request $request)
    {
        // dd($request->all());

        $user_id = $request->user_id;

        // $old_image = $request->old_image;

        $data = array();

        $data['name'] = $request->name;

        $data['email'] = $request->email;

        $data['phone'] = $request->phone;

        if ($request->password) {

            $data['password'] = Hash::make($request->password);
        }

        $email = $request->email;

        $existing_admin_check = DB::table('users')->where('email', $email)->where('id', '!=', $user_id)->exists();

        if ($existing_admin_check) {

            session()->flash('err', 'Sorry Email already registered!');

            return redirect('/cubebooks/user-profile');

        } else {

            $data['email'] = $request->email;
        }

        if ($_FILES['photo']['name'] !== '') {

            $this->validate($request, [

                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            $files = $request->file('photo');

            $filename = $files->getClientOriginalName();

            $picture = date('His') . $filename;

            $image_url = 'public/img/user/' . $picture;

            $destinationPath = base_path() . '/public/img/user';

            $success = $files->move($destinationPath, $picture);

            if ($success) {

                $data['image'] = $image_url;
                DB::table('users')->where('id', $user_id)->update($data);
                session()->flash('msg', 'Admin Information Updated Successfully!');
                return redirect('/cubebooks/user-profile');

            } else {
                $error = $files->getErrorMessage();
            }
            
        } else {

            DB::table('users')->where('id', $user_id)->update($data);

            session()->flash('msg', 'User Information Updated Successfully!');

            return redirect('/cubebooks/user-profile');
        }
    }
}
