<?php

namespace Tests\Feature;

use App\Models\Llibre;
use App\Models\Category;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LlibreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Usa SQLite en memòria
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');

        // Executa totes les migracions
        $this->artisan('migrate');
    }

    /** @test */
    public function pot_crear_un_llibre()
    {
        $categoria = Category::factory()->create();

        $response = $this->post('/llibres/new', [
            'titol' => 'Llibre de prova',
            'autor' => 'Autor Test',
            'resum' => 'Aquest és un resum de prova.',
            'data_publicacio' => '2023-01-01',
            'preu' => 12.50,
            'imatge' => null,
            'edat_minima' => 10,
            'categoria_id' => $categoria->id,
        ]);

        $response->assertStatus(200); // ja que retorna una vista, no redirigeix
        $this->assertDatabaseHas('llibre', [
            'titol' => 'Llibre de prova',
            'autor' => 'Autor Test',
        ]);
    }

    /** @test */
    public function pot_actualitzar_un_llibre()
    {
        $categoria = Category::factory()->create();
        $llibre = Llibre::factory()->create(['categoria_id' => $categoria->id]);

        $response = $this->put("/llibres/{$llibre->id}", [
            'titol' => 'Títol Nou',
            'autor' => $llibre->autor,
            'resum' => $llibre->resum,
            'data_publicacio' => $llibre->data_publicacio,
            'preu' => 19.99,
            'imatge' => $llibre->imatge,
            'edat_minima' => $llibre->edat_minima,
            'categoria_id' => $llibre->categoria_id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('llibre', ['titol' => 'Títol Nou']);
    }

    /** @test */
    public function pot_eliminar_un_llibre()
    {
        $llibre = Llibre::factory()->create();

        $response = $this->delete("/llibres/delete/{$llibre->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('llibre', ['id' => $llibre->id]);
    }
}
