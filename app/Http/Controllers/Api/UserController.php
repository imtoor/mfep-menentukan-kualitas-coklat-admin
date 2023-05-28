<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProductResource;

class UserController extends Controller
{
    public function index() {

        $users = User::latest()->get();
        return new ProductResource(true, 'List Data User', $users);
    }
    
    public function login_user(Request $request) {
        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password) != null) {
            return new ProductResource(true, 'Login Berhasil', $user);
        } else {
            return new ProductResource(false, 'Login Gagal', null);
        }
    }

    public function daftar_user(Request $request) {
        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make('12345');
        $level = 'pelanggan';
        $user->level = $level;
        
        if ($user->save()) {
            return new ProductResource(true, 'Sukses Daftar', []);
        } else {
            return new ProductResource(false, 'Gagal Daftar', []);
        }
    }


}
