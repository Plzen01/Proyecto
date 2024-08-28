@extends('plantilla')
@section('titulo', 'Categorías')

@section('contenido')
    <h1 class="text-center mb-4">Categorías</h1>

    <div class="mb-4">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Crear Nueva Categoría</a>
    </div>

    @forelse($categorias as $categoria)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $categoria->nombre }}</h5>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p>No hay categorías</p>
    @endforelse

    {{ $categorias->links() }}
@endsection
