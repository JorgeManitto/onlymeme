<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titulo = $this->faker->catchPhrase;
        $volanta = $this->faker->catchPhrase;
        $epigrafe = $this->faker->catchPhrase;
        $alt = $this->faker->catchPhrase;
        $slug = Str::of($titulo)->slug('-');
        return [
            'tipo' => $titulo,
            'slug'      => $slug,
            'size'      => $volanta,
            'descripcion' => 'dasd',
            'url' => '',
            'palabras_clave' => '2',
            'user_id' => rand(1, 2000),
        ];
    }
}
