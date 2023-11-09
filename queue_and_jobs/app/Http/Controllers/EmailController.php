<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\CustomerJob;

class EmailController extends Controller
{
    public function SendEmail(){
        dispatch(new CustomerJob);

        return view('welcome');
    }

    public static function for_testing(){
        return view('welcome');
    }
}
