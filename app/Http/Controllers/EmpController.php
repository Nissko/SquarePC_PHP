<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmpController extends Controller
{
    public function downloadPDF(Request $request, $order_id){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
            'photo' => $UserController -> user_photo
        ];
        $orders = Order::findOrFail($order_id);
        $count = $orders -> positions;
        $count = $count->count();

        $pdf = Pdf::loadView('auth.check_order', compact('orders'), compact('count'));

        return $pdf->download('square_check_order'. $orders->id .'.pdf');
    }
}
