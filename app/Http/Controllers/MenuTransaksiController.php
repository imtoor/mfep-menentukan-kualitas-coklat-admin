<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class MenuTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->orderBy('status', 'asc')->get();
        return view('menu_transaksi.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order != null) {
            
            $orderItem = OrderItem::where('order_id', $order->id)->get();
            
            if (count($orderItem) > 0) {

                if (OrderItem::where('order_id', $order->id)->delete()) {
                    if ($order->delete()) {
                        return back()->with('success', 'Data telah dihapus');
                    } else {
                        return back()->with('errors', 'Gagal menghapus data');
                    }
                } else {
                    return back()->with('errors', 'Gagal menghapus data');
                }

            } else {
                if ($order->delete()) {
                    return back()->with('success', 'Data telah dihapus');
                } else {
                    return back()->with('errors', 'Gagal menghapus data');
                }
            }

        } else {
            return back()->with('errors', 'Data tidak ditemukan.');
        }
    }
}
