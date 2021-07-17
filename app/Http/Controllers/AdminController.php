<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
    public function index()
    {
        return view('admin.master');
    }
    public function UserList()
    {
        $data = array();
        $data['title'] = 'User List';
        $data['users'] = User::get();
        return view('admin.users',$data);
    }
}
