<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Comentario::factory(15)->create();
    }
}
