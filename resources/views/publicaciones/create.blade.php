@extends('plantilla')
@section('titulo', 'Crear Publicación')

@section('contenido')
    <h1 class="text-center mb-4">Crear Nueva Publicación</h1>

    <form action="{{ route('publicaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5">{{ old('contenido') }}</textarea>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear Publicación</button>
    </form>
@endsection
