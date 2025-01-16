<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            $user = User::find($id);
            $user -> update($request->all());

            return redirect()->route('admin.user.index');
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
