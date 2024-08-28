<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'contenido', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_publicacion');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
