<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $product = DB::table('products')->get();

        return view('menu_produk.index', ['product' => $product]);
    }

    public function create()
    {
        return view('menu_produk.create');
    }

    public function store(Request $request)
    {
        $validasi = Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kadar_air' => $request->kadar_air,
            'tekstur' => $request->tekstur,
            'aroma' => $request->aroma,
            'satuan' => "kg",
        ]);

        if ($validasi) {
            return redirect('menu-produk')->with('sukses', 'Anggota berhasil ditambahkan!');
        } else {
            return redirect('menu-produk')->with('error', 'Anggota gagal ditambahkan!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produk = Product::find($id);
        return view('menu_produk.edit', ["produk" => $produk]);
    }

    public function update(Request $request, $id)
    {
        $validasi = Product::where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kadar_air' => $request->kadar_air,
            'tekstur' => $request->tekstur,
            'aroma' => $request->aroma,
        ]);

        if ($validasi) {
            return redirect("/menu-produk")->with('sukses', 'User berhasil diedit!');
        } else {
            return redirect("/menu-produk")->with('error', 'User gagal diedit!');
        }
    }

    public function destroy($id)
    {
        $validasi = Product::where('id', $id)->delete();

        if ($validasi) {
            return redirect('menu-produk')->with('sukses', 'Data Produk berhasil dihapus!');
        } else {
            return redirect('menu-produk')->with('error', 'Data Produk gagal dihapus!');
        }
    }
}
