<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

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

        $request->validate([
            'gambar' => 'mimes:jpg,png,jpeg|max:2048'
        ]);        
        
        $img = null;
        if($request->file()) {
            
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            $img = $fileName;

            $destinationPath = public_path().'/img/products';

            try {

                $request->gambar->move($destinationPath, $fileName);

            } catch(Exception $e) {
                return redirect('menu-produk')->with('error', 'Gagal mengupload gambar!!!');
            }

        }
        
        $validasi = Product::create([
            'gambar' => $img,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kadar_air' => $request->kadar_air,
            'tekstur' => $request->tekstur,
            'aroma' => $request->aroma
        ]);

        if ($validasi) {
            return redirect('menu-produk')->with('sukses', 'Produk berhasil ditambahkan!');
        } else {
            return redirect('menu-produk')->with('error', 'Produk gagal ditambahkan!');
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

        $request->validate([
            'gambar' => 'mimes:jpg,png,jpeg|max:2048'
        ]);
        
        $product = Product::find($id);

        $img = null;
        if($request->file()) {

            if (File::exists(public_path().'img/products/'.$product->gambar)) {

                File::delete(public_path().'img/products/'.$product->gambar);
                $product->delete();
            }
            
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            $img = $fileName;

            $destinationPath = public_path().'/img/products';

            try {

                $request->gambar->move($destinationPath, $fileName);

            } catch(Exception $e) {
                return redirect('menu-produk')->with('error', 'Gagal mengupload gambar!!!');
            }
            
            $validasi = Product::where('id', $id)->update([
                'gambar' => $img,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'kadar_air' => $request->kadar_air,
                'tekstur' => $request->tekstur,
                'aroma' => $request->aroma,
            ]);
        } else {

            $validasi = Product::where('id', $id)->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'kadar_air' => $request->kadar_air,
                'tekstur' => $request->tekstur,
                'aroma' => $request->aroma,
            ]);
        }
        
        dd($validasi);

        if ($validasi) {
            return redirect("/menu-produk")->with('sukses', 'Data produk berhasil diupdate!');
        } else {
            return redirect("/menu-produk")->with('error', 'Data produk gagal diupdate!');
        }
    }

    public function destroy($id)
    {

        $product = Product::find($id);
        
         if (File::exists(public_path('img/products/'.$product->gambar))) {

            File::delete(public_path('img/products/'.$product->gambar));
        }

        if ($product->delete()) {

            return redirect('menu-produk')->with('sukses', 'Data Produk berhasil dihapus!');
        } else {
            
            return redirect('menu-produk')->with('error', 'Data Produk gagal dihapus!');
        }
    }
}
