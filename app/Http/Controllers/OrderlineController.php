<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Http\Request;

class OrderlineController extends Controller
{
    public function completeOrder(int $id)
    {
        $orderli = Orderline::find($id);
        $orderli->update(['status' => 5]);

        $orderlines = Orderline::where('order_id', $orderli->order_id)->get();
        foreach ($orderlines as $orderline)
        {
            if($orderline->status != 5)
            {
                return response('Orderline bijgewerkt', 200);
            }
        }
        $order = Order::find($orderli->order_id);
        $order->update(['status' => 5]);
        return response('Alle orderlines van de betreffende orders zijn voltooid. De order zelf is ook voltooid.');
    }
}
