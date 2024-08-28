@extends('plantilla')
@section('titulo', 'Ver Publicación')

@section('contenido')
    <h1 class="text-center mb-4">{{ $publicacion->titulo }}</h1>

    <div class="mb-4">
        <p>{{ $publicacion->contenido }}</p>
        <p><strong>Publicado por:</strong> {{ $publicacion->usuario->name }}</p>
        <p><strong>Fecha:</strong> {{ $publicacion->created_at->format('d M Y') }}</p>
    </div>

    @auth
        @if(auth()->id() === $publicacion->user_id || auth()->user()->administrador)
            <a href="{{ route('publicacion.editar', $publicacion->id) }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('publicacion.destroy', $publicacion->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
    @endauth

    <div class="mt-4">
        <h2>Comentarios</h2>
        @foreach($publicacion->comentarios as $comentario)
            <div class="border p-3 mb-3">
                <p><strong>{{ $comentario->user->name }}:</strong> {{ $comentario->contenido }}</p>
                <p><small>{{ $comentario->created_at->format('d M Y H:i') }}</small></p>
            </div>
        @endforeach

        @auth
            <h3>Agregar Comentario</h3>
            <form action="{{ route('comentario.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <input type="hidden" name="publicacion_id" value="{{ $publicacion->id }}">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea class="form-control" id="contenido" name="contenido" rows="3">{{ old('contenido') }}</textarea>
                    @error('contenido')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Agregar Comentario</button>
            </form>
        @endauth
    </div>
@endsection
