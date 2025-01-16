<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        if (Auth::user() and Auth::user()->role === "admin"){
            $activity = Telegram::getUpdates();
            dd($activity);
        }
        else{
            return redirect()->route('index');
        }
    }

    public function storeMessage(Request $request){
        /*$UserController = new UserController();
        $UserController -> authUser();
        $dataN = $UserController -> user_name;
        $dataS = $UserController -> user_lastname;

        $order = Order::create([
            'price' => 999,
            'status' => 'Оплачен',
            'user_id' => Auth::user()->id,
        ]);


        $order_id = $order->id;
        $order_status = $order->status;
        $order_total = $order->price;
        $order_date = date("d-m-Y");

        $text = "<b>Новый</b> Заказ - $order_id от $order_date\n\n"
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
        ]);*/

        /**/

/*        if (!empty($request->file)){
            $files = $request->file('file');
            foreach ($files as $key => $value){
                (object)$filed = $files[$key];
                Telegram::sendDocument([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', '-802850420'),
                    'document' => InputFile::createFromContents(file_get_contents($filed->getRealPath()), Str::random(10) . '.' . $filed->getClientOriginalExtension())
                ]);
            }

        }*/
        return redirect()->route('index');
    }
}
