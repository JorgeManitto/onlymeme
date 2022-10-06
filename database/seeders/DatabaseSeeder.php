<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\ReactionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2000)->create();
        // \App\Models\Post::factory(100)->create();
        // \App\Models\Reaction::factory(100)->create();
        \App\Models\Category::factory()->create([
            'id'    => '1',
            'titulo'    => 'Últimos memes',
            'slug'      => 'ultimos-memes',
            'color'     => '#fff',
            'in_menu'   => '1',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Argentina',
            'slug'      => 'argentina',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Animales',
            'slug'      => 'animales',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Top memes',
            'slug'      => 'top-memes',
            'color'     => '#fff',
            'in_menu'   => '1',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Películas',
            'slug'      => 'peliculas',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Fútbol',
            'slug'      => 'futbol',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Anime y manga',
            'slug'      => 'anime-y-manga',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Politica',
            'slug'      => 'politica',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Otros',
            'slug'      => 'otros',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
        \App\Models\Category::factory()->create([
            'titulo'    => 'Pepe the Frog',
            'slug'      => 'pepe-the-frog',
            'color'     => '#fff',
            'in_menu'   => '2',
            'estado'    => '2',
        ]);
    }
}
