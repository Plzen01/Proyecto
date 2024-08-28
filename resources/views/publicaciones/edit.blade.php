@extends('plantilla')
@section('titulo', 'Editar Publicación')

@section('contenido')
    <h1 class="text-center mb-4">Editar Publicación</h1>

    <form action="{{ route('publicacion.update', $publicacion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $publicacion->titulo) }}">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5">{{ old('contenido', $publicacion->contenido) }}</textarea>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Publicación</button>
    </form>
@endsection
