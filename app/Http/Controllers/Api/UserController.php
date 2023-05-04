<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class UserController extends Controller
{
    public function index() {

        $users = User::latest()->get();

        return new ProductResource(true, 'List Data User', $users);
    }
}
