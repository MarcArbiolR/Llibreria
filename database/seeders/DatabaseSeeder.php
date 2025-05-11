<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desactivar restriccions de claus foranes
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncar totes les taules
        DB::table('llibre_user')->truncate();
        DB::table('llibre')->truncate();
        DB::table('users')->truncate();
        DB::table('categories')->truncate();

        // Reactivar restriccions de claus foranes
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Cridar les funcions de seeding
        $this->seedCategories();
        $this->seedLlibres();
        $this->seedUsers();
        $this->seedValoracions();

        // Missatge d'èxit
        $this->command->info('Usuaris, categories, valoracions i llibres de prova creats correctament.');
    }

    private function seedUsers()
{
    // Crear usuaris de prova
    DB::table('users')->insert([
        [
            'name' => 'Admin',
            'email' => 'admin@admin.es',
            'password' => Hash::make('admin1234'),
            'data_naixement' => '2006-05-10',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Usuari',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'data_naixement' => '2020-05-03',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Usuari2',
            'email' => 'usuari2@example.com',
            'password' => Hash::make('password123'),
            'data_naixement' => '2012-01-11',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}


    private function seedCategories()
    {
        // Crear categories de prova
        DB::table('categories')->insert([
            [
                'name' => 'Ficció',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'No Ficció',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ciència',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    private function seedLlibres()
    {
        // Obtenir les categories per id dinàmicament
        $ficcio = DB::table('categories')->where('name', 'Ficció')->first();
        $noFiccio = DB::table('categories')->where('name', 'No Ficció')->first();

        // Crear llibres de prova
        DB::table('llibre')->insert([
            [
                'titol' => 'El Senyor dels Anells',
                'autor' => 'J.R.R. Tolkien',
                'resum' => 'Una història èpica de fantasia.',
                'data_publicacio' => '1954-07-29',
                'preu' => 29.99,
                'imatge' => 'https://www.elpuntavui.cat/imatges/59/43/alta/780_0008_5943159_2e3835441f750e34a96aeef363245c5b.jpg',
                'edat_minima' => 12,
                'categoria_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titol' => 'Sapiens: A Brief History of Humankind',
                'autor' => 'Yuval Noah Harari',
                'resum' => 'Una exploració de la història de la humanitat.',
                'data_publicacio' => '2011-01-01',
                'preu' => 19.99,
                'imatge' => 'https://m.media-amazon.com/images/I/61i4k7DWNFL._AC_UF1000,1000_QL80_.jpg',
                'edat_minima' => 16,
                'categoria_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    private function seedValoracions()
    {
        // Crear valoracions de prova
        DB::table('llibre_user')->insert([
            [
                'user_id' => 2,
                'llibre_id' => 1,
                'nota' => 5,
                'valoracio' => 'Un llibre increïble!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'llibre_id' => 2,
                'nota' => 7,
                'valoracio' => 'Molt interessant.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
