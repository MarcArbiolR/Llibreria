@extends('layouts.master')
@section('title', 'Afegir valoració')

@section('content')
    <div class="container mt-5">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <!-- Recuperem el llibre amb l'ID -->
                @php
                    $llibre = \App\Models\Llibre::find($llibreId);
                @endphp

                <!-- Mostrem la imatge del llibre -->
                <div class="card shadow-sm">
                    <img src="{{ $llibre->imatge ?? 'res' }}" alt="Imatge del llibre" class="img-fluid rounded">
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <!-- Mostrem el títol del llibre -->
                    <h1>{{ $llibre->titol ?? 'Títol no disponible' }}</h1>

                    <form action="{{ route('valoracions.new') }}" method="POST">
                        @csrf

                        <!-- Inputs ocults per a usuari i llibre -->
                        <input type="hidden" name="user_id" value="{{ $usuariId }}">
                        <input type="hidden" name="llibre_id" value="{{ $llibreId }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nota" class="form-label"><strong>Puntuació (1-10):</strong></label>
                                <select class="form-control" id="nota" name="nota" required>
                                    <option value="">Selecciona</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="valoracio" class="form-label"><strong>Valoració:</strong></label>
                                <textarea class="form-control" id="valoracio" name="valoracio" rows="4" required></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">Afegir valoració</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection