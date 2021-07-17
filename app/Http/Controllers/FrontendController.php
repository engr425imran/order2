<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class FrontendController extends Controller
{
	public function crmlogin(){
        return view('pages.new.crms-login');
    }
}