<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->get();
        return new UserResource(true, 'List Data User', $users);
    }
    
    public function login_user(Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                return new UserResource(true, 'Login Berhasil', $user);
            } else {
                return new UserResource(false, 'Email atau Password Salah', null);
            }
        } else {
            return new UserResource(false, 'Email atau Password Salah', null);
        }

    }

    public function daftar_user(Request $request) {
        
        if($request->password != $request->confirm_password) {
            return new UserResource(false, 'Gagal Daftar Password Tidak Sama', []);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->level = 'pelanggan';

        if ($user->save()) {
            return new UserResource(true, 'Sukses Daftar', []);
        } else {
            return new UserResource(false, 'Gagal Daftar', []);
        }
    }


}
