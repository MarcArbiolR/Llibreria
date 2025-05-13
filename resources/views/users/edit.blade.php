@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Editar Usuari: {{ $user->name }}</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contrasenya</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contrasenya</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="data_naixement" class="form-label">Data de Naixement</label>
                <input type="date" class="form-control" id="data_naixement" name="data_naixement"
                    value="{{ old('data_naixement', $user->data_naixement->format('Y-m-d')) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Desar Canvis</button>
        </form>
    </div>
@endsection
