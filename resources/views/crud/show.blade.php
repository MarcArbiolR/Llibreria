@extends('layouts.master')

@section('title', 'Veure llibre')

@section('content')
    <div class="container mt-5">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <!-- Mostrem la imatge del llibre -->
                <div class="card shadow-sm">
                    <img src="{{ $llibre->imatge }}" class="card-img-top rounded" alt="Imatge del llibre" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <!-- Mostrem el títol del llibre -->
                    <h1 class="display-4">{{ $llibre->titol }}</h1>
                    <hr>
                    <!-- Mostrem l'autor del llibre -->
                    <h4>Autor: <span class="fw-bold">{{ $llibre->autor }}</span></h4>
                    <!-- Mostrem la data de publicació -->
                    <h4>Data de publicació: <span class="fw-bold">{{ $llibre->data_publicacio }}</span></h4>
                    <!-- Mostrem el preu -->
                    <h4>Preu: <span class="fw-bold">{{ number_format($llibre->preu, 2) }} €</span></h4>
                    <!-- Mostrem la categoria del llibre -->
                    <h4>Categoria: <span class="fw-bold">{{ $categoria->name ?? 'Sense categoria' }}</span></h4>
                    <!-- Mostrem el resum -->
                    <p class="mt-3"><strong>Resum:</strong> {{ $llibre->resum }}</p>
                    <!-- Mostrem l'edat mínima si està disponible -->
                    @if ($llibre->edat_minima)
                        <h4>Edat mínima recomanada: <span class="fw-bold">{{ $llibre->edat_minima }} anys</span></h4>
                    @endif

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <!-- Enllaç per tornar al llistat -->
                        <a href="{{ url('/llibres') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-arrow-left"></i> Tornar al llistat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h3 class="mb-4">Valoracions</h3>

            @forelse ($llibre->valoracions as $usuari)
                <div class="mb-3 border-bottom pb-2">
                    <strong>{{ $usuari->name }}</strong>
                    <span class="text-muted"> - {{ $usuari->pivot->created_at->format('d/m/Y') }}</span>
                    <div>
                        <span class="badge bg-warning text-dark">Nota: {{ $usuari->pivot->nota }}/10</span>
                    </div>
                    <p>{{ $usuari->pivot->valoracio }}</p>
                </div>
            @empty
                <p>Encara no hi ha valoracions.</p>
            @endforelse



        </div>
    </div>

@endsection