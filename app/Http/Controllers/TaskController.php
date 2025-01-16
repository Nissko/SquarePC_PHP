<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Position;
use App\Models\User;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskController extends Controller
{
    public function index(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        return view('main')->with(['data'=>$data]);
    }

    public function info(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        return view('info')->with(['data'=>$data]);
    }

    public function project(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        return view('project')->with(['data'=>$data]);
    }

    public function account(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
            'photo' => $UserController -> user_photo
        ];
        if(Auth::user()){
            $orders = Order::all()->where('user_id', $data->id)->sortDesc();
            $count = $orders -> count();
            $total = Order::where('user_id', $data -> id)->sum('price');
            return view('auth.account')
                ->with('total', $total)
                ->with('count', $count)
                ->with(['orders'=>$orders])
                ->with(['data'=>$data]);
        }
        return view('auth.auth')->with(['data' => $data]);
    }

    public function checkOrder(Request $request, $order_id){
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
            $total = Order::where('user_id', $data -> id)->sum('price');
            return view('auth.check_order')
                ->with('total', $total)
                ->with('count', $count)
                ->with(['orders'=>$orders])
                ->with(['data'=>$data]);
    }

    public function ShowOrder(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_lastname,
            ];

            $orders = Order::all()->where('user_id', $data->id)->sortDesc();
            $count = $orders -> count();
            $total = Order::where('user_id', $data -> id)->sum('price');

            $datas = view('auth.order_account')
                ->with('total', $total)
                ->with('count', $count)
                ->with(['orders'=>$orders])
                ->with(['data'=>$data])
                ->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function changePhoto(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_lastname,
            ];

            $datas = view('auth.account_photo')->with(['data' => $data])->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function userPhotoChange(Request $request, User $user){
        $file = $request->file('photo');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->move('storage/img/account_photo', $filename);
        $user->update([
            'photo' => $filename
        ]);

        return redirect()->route('account');
    }

    public function changePassword(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_lastname,
            ];

            $datas = view('auth.user_password')->with(['data' => $data])->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function userPasswordChange(Request $request, User $user){
        $password = $request->password;
        $password_verification = $request->new_password;

        if ($password === $password_verification){
            $user->update([
                'password' => Hash::make($password)
            ]);
            Auth::logout();
            return redirect()->route('login');
        }
        else{
            return redirect()->back();
        }
    }

    public function cart(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        $cart = \Cart::session($_COOKIE['cart_id'])->getContent();
        $CartList = $cart->sort();
        $position = Position::all();
        $total = Cart::session($_COOKIE['cart_id'])->getTotal();

        if(Auth::user()) {
            return view('cart.cart', ['position' => $position, 'total' => $total], compact('CartList'))->with(['data' => $data]);
        } else{
            return view('auth.auth')->with(['data' => $data]);
        }
    }

    public function addToCart(Request $request){
        if($request->ajax()){
            $model = Package::find($request->id);
            $positions = Position::all()->where('model_name', $request -> build_name)
                ->where('package_name', $request -> complectation) // start
                ->first();
            $cart_id = $_COOKIE['cart_id'];

            if (\Cart::session($cart_id)->get($request->id) !== null) {
                return false;
            } else{
                \Cart::session($cart_id)->add([
                    'id' => $request -> id, // inique row ID
                    'name' => $positions -> model_name, //
                    'price' => $positions -> price,
                    'quantity' => 1,
                    'attributes' => [
                        'package_name' => $positions -> package_name,
                        'qty_ram' => $positions -> count_ram,
                        'cpu_id' => $positions -> cpu_id,
                        'motherboard_id' => $positions->motherboard_id,
                        'ram_id' => $positions -> ram_id,
                        'gpu_id' => $positions -> gpu_id,
                        'psu_id' => $positions -> psu_id,
                        'corp_id' => $positions -> corp_id,
                        'disk_id' => $positions -> disk_id,
                        'info_model' =>$model,
                        'isReadyConfig' => "yes",
                    ]
                ]);

                return response()->json(Cart::getContent());
            }
        }

    }

    public function DeleteCart(Request $request){
        if($request->ajax()){
            $cart_id = $_COOKIE['cart_id'];
            \Cart::session($cart_id)->remove($request->id);

            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_lastname,
            ];

            $cart = \Cart::session($_COOKIE['cart_id'])->getContent();
            $CartList = $cart->sort();
            $position = Position::all();
            $total = Cart::session($_COOKIE['cart_id'])->getTotal();

            $data = view('cart.delete', ['position' => $position, 'total' => $total], compact('CartList'))->with(['data' => $data])->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function UpdateCart(Request $request){
        if($request->ajax()){
            $cart_id = $_COOKIE['cart_id'];
            \Cart::session($cart_id)->update($request->id, [
                'quantity' => [
                    "relative" => false,
                    'value' => $request->qty
                ]
            ]);

            $cart = \Cart::session($_COOKIE['cart_id'])->getContent();
            $CartList = $cart->sort();
            $position = Position::all();
            $total = Cart::session($_COOKIE['cart_id'])->getTotal();

            $data = view('cart.update', ['position' => $position, 'total' => $total], compact('CartList'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function CardForm(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        return view('cart.form_card')->with(['data' => $data]);
    }

    public function MakeOrder() {
        if (Auth::user()){
            $UserController = new UserController();
            $UserController -> authUser();
            $dataN = $UserController -> user_name;
            $dataS = $UserController -> user_lastname;

            $cart = \Cart::session($_COOKIE['cart_id'])->getContent();
            $total_price = Cart::session($_COOKIE['cart_id'])->getTotal();

            /* Преобразование корзины в массив */
            $cartItems = $cart->map(function ($item) {
               return [
                   'id' => $item->id,
                   'name' => $item->name,
                   'price' => $item->price,
                   'qty' => $item -> quantity
               ];
            });

            /* Создание заказа */
            $order = Order::create([
                'price' => $total_price,
                'status' => 'Оплачен',
                'user_id' => Auth::user()->id,
            ]);

            /* Уведомление в канале */

            $order_id = $order->id;
            $order_status = $order->status;
            $order_total = $order->price;
            $order_date = date("d-m-Y");

            $text = "Новый Заказ - $order_id от $order_date\n\n"
                . "<b>Клиент: </b>\n"
                . "$dataS $dataN\n\n"
                . "<b>Статус заказа: </b>\n"
                . "$order_status\n\n"
                . "Сумма заказа:\n"
                . "$order_total рублей.";

            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001983916466'),
                'parse_mode' => 'HTML',
                'text' => $text
            ]);

            /**/

            /* Добавление в промежуточную таблицу */
            foreach ($cartItems as $carts) {
                $order->Positions()->attach($carts['id'], ['count_position' => $carts['qty']]);
            }

            /* Изменение кол-ва готовых конфигураций */
            foreach ($cart as $cartItem){
                if ($cartItem -> attributes -> isReadyConfig === "yes"){
                    $modelDB = Package::find($cartItem->id);
                    $modelDB->update([
                        "count" => $modelDB->count - $cartItem->quantity
                    ]);
                }
            }

            \Cart::session($_COOKIE['cart_id'])->clear();

            return redirect()->route('account');
        } else {
            return redirect()->route('index');
        }
    }
}
