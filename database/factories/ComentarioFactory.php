<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition()
    {
        return [
            'contenido' => $this->faker->text,
            'user_id' => User::factory(),
            'publicacion_id' => Publicacion::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
