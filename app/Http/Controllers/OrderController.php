<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function allUserOrders()
    {
        $order = Order::all()->where(['user_id'=>Auth::user()->id]);
    }

    public function makeOrder(Request $request){

        $order = Order::find($request->orderId);
        if(!$order) {
            return ['result'=>false, 'message'=>'Не удалось оформить заказ, попробуйте позже'];
        }

            $order->name = $request->user['name'];
            $order->phone = $request->user['phone'];
            $order->address = $request->user['address'];
            $order->final_price = $request->finalPrice;
            $order->status_id = 1;
            if(!$order->save()){
                return ['resutl' => false, 'message'=>'Произошла ошибка при оформлении заказа'];
            }
            session()->forget('orderId');
            return ['resutl' => true, 'message'=>'Заказ оформлен'];
    }
}
