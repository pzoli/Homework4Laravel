<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index',['users'=>$users]);
    }
}
