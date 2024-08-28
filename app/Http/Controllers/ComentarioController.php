<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth; 
use App\Notifications\ComentarioNotificado; 

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
            'publicacion_id' => 'required|exists:publicaciones,id',
        ]);

        $comentario = new Comentario();
        $comentario->contenido = $request->input('contenido');
        $comentario->user_id = Auth::id();
        $comentario->publicacion_id = $request->input('publicacion_id');

        if ($comentario->save()) {
            $publicacion = Publicacion::findOrFail($comentario->publicacion_id);
            if ($publicacion->user_id != Auth::id()) {
                $user = $publicacion->user;
                $user->notify(new ComentarioNotificado($comentario));
            }

            return redirect()->route('publicacion.show', $comentario->publicacion_id)
                ->with('exito', 'El comentario se guardó correctamente');
        } else {
            return redirect()->route('publicacion.show', $comentario->publicacion_id)
                ->with('error', 'El comentario no se pudo guardar.');
        }
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $publicacion_id = $comentario->publicacion_id;

        if ($comentario->delete()) {
            return redirect()->route('publicacion.show', $publicacion_id)
                ->with('exito', 'El comentario se eliminó correctamente');
        } else {
            return redirect()->route('publicacion.show', $publicacion_id)
                ->with('error', 'El comentario no se pudo eliminar.');
        }
    }
}
