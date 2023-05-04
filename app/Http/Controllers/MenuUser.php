<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenuUser extends Controller

{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $level = 'pelanggan';
        $user = User::where('level', $level)->get();
        
        return view('menu_userpelanggan.index', ['user' => $user]);
    }

    public function create()
    {
        $user = User::all();
        return view('menu_userpelanggan.create', compact('user'));
    }
    
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->exists()) 
        {
         return redirect('menu-userpelanggan/create')->with('error_email', 'Email telah terdaftar sebelumnya!');
        }

        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('12345');
        $level = 'pelanggan';
        $user->level = $level;

        if($user->save()) {
            return redirect('/menu-userpelanggan')->with('sukses', 'User berhasil ditambahkan!');
        } else {
            return redirect('/menu-userpelanggan')->with('error', 'User gagal ditambahkan!');
        }
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
        $user = User::find($id);
        return view('menu_userpelanggan.edit', ["user" => $user]);
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
        $validasi = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if ($validasi) {
            return redirect("/menu-userpelanggan")->with('sukses', 'User berhasil diedit!');
        } else {
            return redirect("/menu-userpelanggan")->with('error', 'User gagal diedit!');
        }
    }

    public function reset_password(Request $request, $id)
    {
        $validasi = User::where('id', $id)->update([
            "password" => Hash::make('12345')
        ]);

        if ($validasi) {
            return redirect('menu-userpelanggan')->with('sukses', 'User berhasil di reset password!');
        } else {
            return redirect('menu-userpelanggan')->with('error', 'User gagal di reset password!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validasi = User::where('id', $id)->delete();

        if ($validasi) {
            return redirect('menu-userpelanggan')->with('sukses', 'User berhasil dihapus!');
        } else {
            return redirect('menu-userpelanggan')->with('error', 'User gagal dihapus!');
        }
    }
}