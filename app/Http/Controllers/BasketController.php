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




        if ($orderBurgers = OrderBurger::where(['burger_id' => $request->burgerId, 'order_id' => $orderId])->first()) {
            $orderBurgers->count += (int)$request->count;
            $orderBurgers->update();

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

        $orderBurgers = OrderBurger::where('burger_id', $request->burgerId)->first();

        if(!$orderBurgers->delete())
        {
            return abort(400, 'Bad request');
        }

        return redirect()->back();
    }

    public function basket(Request $request)
    {
        $orderBurgers = OrderBurger::where('order_id', session('orderId'))->with('burger')->get();

        return view('basket.index', compact('orderBurgers'));
    }
}
