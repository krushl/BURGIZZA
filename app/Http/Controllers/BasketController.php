<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderBurger;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
//    public function basketAdd(Request $request)
//    {
//        $orderId = session('orderId');
//
//        if (is_null($orderId))
//        {
//            $order = Order::create(
//                [
//                  'user_id' => Auth::user()->id,
//                   'date' => (new DateTime())->format('d-m-Y'),
//                    'status_id' => 3,
//                    'final_price' => 3,
//                    'phone' => 3,
//                    'address' => 3,
//                ],
//            );
//            session(['orderId' => $order->id]);
//        } else {
//            $order = Order::find($orderId);
//        }
//
//
//         if($orderBurgers = OrderBurger::where('burger_id',$request->burgerId)->first())
//         {
//             if($orderBurgers->special_requests != json_encode($request->composition,JSON_UNESCAPED_UNICODE) ) {
//                 $orderBurgers->count += $request->count;
//                 if(!$orderBurgers->update())
//                 {
//                     return redirect()->back();
//                 }
//             } else {
//                 $orderBurgers = OrderBurger::create(
//                     [
//                         'burger_id' => $request->burgerId,
//                         'order_id' => $order->id,
//                         'count' => $request->count,
//                         'special_requests' =>json_encode($request->composition,JSON_UNESCAPED_UNICODE) ?? 1,
//                         'add_ingredients' => 1,
//                     ],
//                 );
//
//                 if(!$orderBurgers->save())
//                 {
//                     return redirect()->back();
//                 }
//             }
//
//
//         } else {
//             $orderBurgers = OrderBurger::create(
//                 [
//                     'burger_id' => $request->burgerId,
//                     'order_id' => $order->id,
//                     'count' => $request->count,
//                     'special_requests' =>json_encode($request->composition,JSON_UNESCAPED_UNICODE) ?? 1,
//                     'add_ingredients' => 1,
//                 ],
//             );
//
//             if(!$orderBurgers->save())
//             {
//                 return redirect()->back();
//             }
//
//         }
//        return redirect()->back();
//    }

    public function basketAdd(Request $request)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create(
                [
                    'user_id' => Auth::user()->id,
                    'date' => (new DateTime())->format('d-m-Y'),
                    'status_id' => 3,
                    'final_price' => 3,
                    'phone' => 3,
                    'address' => 3,
                ],
            );
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }


        if ($orderBurgers = OrderBurger::where('burger_id', $request->burgerId)->first()) {
            $orderBurgers->count += $request->count;
            if (!$orderBurgers->update()) {
                return redirect()->back();
            }
        } else {
            $orderBurgers = OrderBurger::create(
                [
                    'burger_id' => $request->burgerId,
                    'order_id' => $order->id,
                    'count' => $request->count,
                    'special_requests' => 1,
                    'add_ingredients' => 1,
                ],
            );

            if (!$orderBurgers->save()) {
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function basketDestroy(Request $request)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
           return redirect()->route('home');
        }
        $order = Order::find($orderId);

        $orderBurgers = OrderBurger::where('burger_id', $request->burgerId)->first();

        if(!$orderBurgers->delete())
        {
            return abort(400, 'Bad request');
        }

        return redirect()->back();
    }

    public function basket(Request $request)
    {
        $orderBurgers = OrderBurger::where('order_id', session('orderId'))->with('burger','order')->get();

        return view('basket.index', compact('orderBurgers'));
    }
}
