<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){

        $usertype=Auth::User()->usertype;
        $username=Auth::user()->name;
        if($usertype=='1'){
            return view('admin.home',compact('username'));
        }
        else{
                $data=Products::paginate(6);
                return view('users.home',compact('data'));
        }

    }
    public function index(){

        if(Auth::id()){
            return redirect('/redirect');
        }
        else{
                $data=Products::paginate(6);
                return view('users.home',compact('data'));
        }
    }
    public function details(Request $request){
        return view('users.product_details',compact('request'));
    }
    
}
