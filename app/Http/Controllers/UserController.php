<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $user_id;
    public $user_role;
    public $user_name;
    public $user_lastname;
    public $user_photo;

    function authUser(){
        if (Auth::check()){
            $user = Auth::user();
            $this -> user_id = $user -> id;
            $this -> user_name = $user -> first_name;
            $this -> user_lastname = $user -> last_name;
            $this -> user_role = $user -> role;
            $this -> user_photo = $user -> photo;
            $this -> user_password = $user-> password;
            if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        }
        else{
            $this -> user_role = 'guest';
        }
    }

    public function index(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        return view('layouts.layout')->with(['data' => $data]);
    }

    public function create(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        return view('auth.reg')->with(['data' => $data]);
    }
    public function store(Request $request){
        User::create([
                'password' => Hash::make($request->password),
            ] + $request->all());
        return redirect()->route('index');
    }
    public function login(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        return view('auth.auth')->with(['data' => $data]);
    }

    public function signup(Request $request){
        if (Auth::attempt($request -> only(['email', 'password']))){
            return redirect()->route('index');
        }

        return redirect()->back();
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();
            return redirect()->route('index');
        }
    }
}
