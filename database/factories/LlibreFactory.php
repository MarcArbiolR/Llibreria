<?php

namespace Database\Factories;

use App\Models\Llibre;
use Illuminate\Database\Eloquent\Factories\Factory;

class LlibreFactory extends Factory
{
    protected $model = Llibre::class;

    public function definition()
    {
        return [
            'titol' => $this->faker->sentence(3), // título de 3 palabras
            'autor' => $this->faker->name(),
            'resum' => $this->faker->paragraph(3),
            'data_publicacio' => $this->faker->date(),
            'preu' => $this->faker->randomFloat(2, 5, 100), // precio entre 5 y 100
            'imatge' => $this->faker->imageUrl(200, 300, 'books', true),
            'edat_minima' => $this->faker->numberBetween(0, 18),
            'categoria_id' => \App\Models\Category::factory(), // crea una categoría relacionada
        ];
    }
}
