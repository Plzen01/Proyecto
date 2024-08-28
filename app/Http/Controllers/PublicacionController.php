<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::with('user', 'categorias')->latest()->get();
        return view('publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('publicaciones.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categorias' => 'array'
        ]);

        $publicacion = new Publicacion();
        $publicacion->titulo = $request->titulo;
        $publicacion->contenido = $request->contenido;
        $publicacion->user_id = Auth::id();
        $publicacion->save();

        if ($request->has('categorias')) {
            $publicacion->categorias()->attach($request->categorias);
        }

        return redirect()->route('publicaciones.index')->with('success', 'Publicación creada con éxito.');
    }

    public function edit(Publicacion $publicacion)
    {
        $categorias = Categoria::all();
        return view('publicaciones.edit', compact('publicacion', 'categorias'));
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categorias' => 'array'
        ]);

        $publicacion->titulo = $request->titulo;
        $publicacion->contenido = $request->contenido;
        $publicacion->save();

        if ($request->has('categorias')) {
            $publicacion->categorias()->sync($request->categorias);
        }

        return redirect()->route('publicaciones.index')->with('success', 'Publicación actualizada con éxito.');
    }

    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();
        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada con éxito.');
    }
}
