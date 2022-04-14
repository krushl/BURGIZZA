<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderBurger;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
//
    public function basketAdd(Request $request)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create(
                [
                    'user_id' => Auth::user()->id,
                    'date' => '2022-09-04',
                    'status_id' => 3,
                    'final_price' => 3,
                    'phone' => 3,
                    'address' => 3,
                ],
            );
            session(['orderId' => $order->id]);
            return redirect()->route('basket');
        }else {
            $order = Order::find($orderId);
        }


       if($order->burgers->contains('burger_id',$request->burgerId))
       {

           $count = $order->burgers()->where('burger_id',$request->burgerId)->first()->count;
           $count+=$request->count;
           OrderBurger::where(['burger_id'=>$request->burgerId,'order_id'=>$order->id])->update(['count'=>$count]);

        } else {
            $orderBurgers = OrderBurger::create(
                [
                    'burger_id' => $request->burgerId,
                    'order_id' => $orderId,
                    'count' => 1,
                    'special_requests' => 1,
                    'add_ingredients' => 1,
                ],
            );

            if (!$orderBurgers->save()) {
                return redirect()->route('basket');
            }
        }
        return redirect()->route('basket');
    }

    public function basketDestroy(Request $request)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
           return redirect()->route('home');
        }
        $order = Order::find($orderId);

        if(!$order->burgers()->where('burger_id',$request->burgerId)->delete())
        {
            return ['result'=>false,'message'=>'При удалении произошла ошибка'];
        }
        return ['result'=>true,'message'=>'Успешно удалено'];

    }

    public function basket(Request $request)
    {
        $orderBurgers = OrderBurger::where('order_id', session('orderId'))->with('burger')->get()->sortBy('burger_id');

        return view('basket.index', compact('orderBurgers'));
    }
}
