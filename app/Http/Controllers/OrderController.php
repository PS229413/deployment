<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(int $id)
    {
        if (!Order::find($id)) {
            return response('Order not found', 404);
        }
        $order = Order::find($id);
        if(Customer::find($order->customerId)){
            $customer = Customer::find($order->customerId);
        }
        else{
            $customer = [
                'firstname' => $order->receiver_firstname,
                'lastname' => $order->receiver_lastname,
                'address' => $order->receiver_address,
                'postcode' => $order->receiver_postalcode,
                'city' => $order->receiver_city,
                'phone' => $order->receiver_phone,
                'email' => $order->receiver_email,
                'country' => $order->receiver_country,
            ];
        }
        $orderlines = Orderline::where('order_id', $id)->get();
        $products = []; // Initialiseer de array buiten de loop

        foreach ($orderlines as $orderline) {
            $product = Product::find($orderline->product_id);
            $normalprice = $product->supplier_price * (1 + $product->price_margin);
            $price = $normalprice * ((100 - $product->discount) / 100);

            $products[] = [
                'name' => $product->name,
                'description' => $product->description,
                'amount' => $orderline->amount,
                'price' => $price,
                'normal_price' => $normalprice,
                'discount' => $product->discount,
                'totalprice' => $price * $orderline->amount
            ];
        }
        $data[] = [
            'id' => $order->id,
            'customer' => $customer,
            'products' => $products,
        ];
        return $data;
    }
}
