<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{

    public function index() {
        $orders = Order::latest()->get();
        return new OrderResource(true, 'List Order', $orders);
    }

    public function store(Request $request) {

        $order = new Order;
        $order->users_id = $request->forms['users_id'];
        $order->address = $request->forms['address'];
        $order->email = $request->forms['email'];
        $order->phone = $request->forms['phone'];
        $order->note = $request->forms['note'];
        $order->payment_method = $request->forms['payment_method'];
        $order->bank = $request->forms['bank'];
        $order->bank_holder = $request->forms['bank_holder'];
        $order->bank_number = $request->forms['bank_number'];
        $order->delivery_name = $request->forms['delivery'];
        $order->delivery_price = $request->forms['delivery_price'];
        $order->status = 0;
        $order->total = $request->forms['total'];

        if ($order->save()) {

            $orderItem = [];
            for ($i=0; $i < count($request->item); $i++) { 

                $product = Product::find($request->item[$i]['id']);
                Product::where('id', $request->item[$i]['id'])->update(['stok' => ($product->stok - $request->item[$i]['qty'])]);

                $orderItem[] = [
                    'order_id' => $order->id,
                    'products_id' => $request->item[$i]['id'],
                    'qty' => $request->item[$i]['qty']
                ];
            }
            
            if (OrderItem::insert($orderItem)) {
                return new OrderResource(true, 'Pesanan telah dibuat', ['order_id' => $order->id]);
            }

            return new OrderResource(false, 'Pesanan gagal dibuat', []);

        } else {
            return new OrderResource(false, 'Pesanan gagal dibuat', []);
        }

    }

    public function show($id) {
        $order = Order::with(['order_item' => function($query) {
            return $query->with('products')->get();
        }])->where('id', $id)->first();
        if ($order != null) {
            return new OrderResource(true, 'Data ditemukan', $order);
        } else {
            return new OrderResource(false, 'Data tidak ditemukan', null);
        }
    }

    public function update_status(Request $request) {
        $order = Order::where('id', $request->id)->update(['status' => $request->status]);
        if ($order) {
            return new OrderResource(true, 'Status berhasil diupdate', null);
        } else {
            return new OrderResource(false, 'Status gagal diupdate', null);
        }
    }

}
