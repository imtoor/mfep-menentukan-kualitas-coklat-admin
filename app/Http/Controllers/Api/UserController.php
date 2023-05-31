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

        if (Hash::check($request->password, $user->password)) {
            return new ProductResource(true, 'Login Berhasil', $user);
        } else {
            return new ProductResource(false, 'Email atau Password Salah', null);
        }
    }

    public function daftar_user(Request $request) {
        
        if($request->password != $request->confirm_password) {
            return new ProductResource(false, 'Gagal Daftar Password Tidak Sama', []);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->level = 'pelanggan';

        if ($user->save()) {
            return new ProductResource(true, 'Sukses Daftar', []);
        } else {
            return new ProductResource(false, 'Gagal Daftar', []);
        }
    }


}
