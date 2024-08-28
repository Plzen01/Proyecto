<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index',$usuarios);
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show',$usuario);
    }
}
