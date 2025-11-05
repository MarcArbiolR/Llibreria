<?php

/* use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('la pàgina de login es pot mostrar', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('els usuaris es poden autenticar des del formulari de login', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('dashboard'));
});

test('no es pot autenticar amb una contrasenya incorrecta', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'contraseña-incorrecta',
    ]);

    $this->assertGuest();
});

test('un usuari pot tancar sessió', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
}); */
