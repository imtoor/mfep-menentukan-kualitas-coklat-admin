<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->level == "admin") {
            $data = [
                'products' => Product::count(),
                'pelanggan' => User::where('level', 'pelanggan')->count(),
                'pemasukan' => Order::where('status', 3)->sum('total')
            ];
        } else {
            $data = [
                'order' => Order::where('users_id', auth()->user()->id)->orderBy('id', 'desc')->first()
            ];        
        }

        return view('dashboard.index', compact('data'));
    }
}
