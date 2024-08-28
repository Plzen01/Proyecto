<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    protected $model = Publicacion::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'contenido' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


    // Realizamos asignaciones asi como numero de categorias de 1 a 5
    public function configure()
    {
        return $this->afterCreating(function (Publicacion $publicacion) {
            $categoriasCount = rand(1, 5);
            $categorias = Categoria::factory()->count($categoriasCount)->create();
            $publicacion->categorias()->attach($categorias);


            $comentariosCount = rand(1, 5);
            Comentario::factory()->count($comentariosCount)->create([
                'publicacion_id' => $publicacion->id,
            ]);
        });
    }
}
