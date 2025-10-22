<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Llibre;
use App\Models\User;
use App\Models\Category;


class LlibreSeeder extends Seeder
{
    public function run()
    {
        Category::truncate();
        $categories = ['Ficció', 'No-ficció', 'Infantil', 'Història', 'Ciència'];
        foreach ($categories as $nom) {
            Category::firstOrCreate(['name' => $nom]);
        }

        Llibre::factory(50)->create()->each(function ($llibre) {
            // Assignem entre 1 i 5 valoracions aleatòries d'usuaris
            $usuaris = User::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($usuaris as $usuari) {
                $llibre->valoracions()->attach($usuari->id, [
                    'nota' => rand(1, 5), // nota entre 1 i 5
                    'valoracio' => fake()->sentence(10), // comentari aleatori
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
