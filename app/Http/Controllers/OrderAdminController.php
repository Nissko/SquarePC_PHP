<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAdminController extends Controller
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
            $order = Order::find($id);
            $order -> update([
                'status' => $request -> status_order_change,
                'message_status' => null
            ]);

            return redirect()->route('admin.order.index');
        }
        else{
            return redirect()->back();
        }
    }

    public function CancelUpdate(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            $order = Order::find($id);
            $order -> update([
                'status' => 'Отменен',
                'message_status' => $request -> order_cancel_reason
            ]);

            return redirect()->route('admin.order.index');
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
