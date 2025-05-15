@extends('layouts.master')

@section('title', 'Veure llibre')

@section('content')
    <div class="container-fluid llibre-container">
        <!-- Notificació d'èxit -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 mt-4">
            <!-- Imatge del llibre -->
            <div class="col-md-4 text-center">
                <div class="card shadow-sm llibre-card-img">
                    <img src="{{ $llibre->imatge }}" class="card-img-top rounded llibre-img" alt="{{ $llibre->titol }}" />
                </div>
            </div>

            <!-- Detalls del llibre -->
            <div class="col-md-8">
                <div class="card p-4 shadow-sm llibre-card-details">
                    <h1 class="display-4 llibre-title">{{ $llibre->titol }}</h1>
                    <hr class="divider">
                    <div class="llibre-info">
                        <h4>Autor: <span class="fw-bold">{{ $llibre->autor }}</span></h4>
                        <h4>Data de publicació: <span class="fw-bold">{{ $llibre->data_publicacio }}</span></h4>
                        <h4>Preu: <span class="fw-bold">{{ number_format($llibre->preu, 2) }} €</span></h4>
                        <h4>Categoria: <span class="fw-bold">{{ $categoria->name ?? 'Sense categoria' }}</span></h4>
                        @if ($llibre->edat_minima)
                            <h4>Edat mínima recomanada: <span class="fw-bold">{{ $llibre->edat_minima }} anys</span></h4>
                        @endif
                        <p class="mt-3"><strong>Resum:</strong> {{ $llibre->resum }}</p>
                    </div>

                    <!-- Botons d'accions -->
                    <div class="btn-group mt-4" role="group" aria-label="Accions del llibre">
                        @if (Auth::user() && Auth::user()->email == 'admin@admin.es')
                            <a href="{{ url('/llibre/edit/' . $llibre->id) }}" class="llibre-btn edit me-3"
                                style="margin-right: 20px">Editar el llibre</a>
                            <form action="{{ route('crud.delete', $llibre->id) }}" method="POST"
                                onsubmit="return confirm('Vols eliminar el llibre?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="llibre-btn delete me-3"
                                    style="margin-right: 20px">Eliminar</button>
                            </form>
                        @endif

                        @if (Auth::check() && !$hasValoracio)
                            <a href="{{ url('/valoracions/create/' . $llibre->id . '/' . auth()->user()->id) }}"
                                class="llibre-btn rate me-3" style="margin-right: 20px">Afegir una valoració</a>
                        @elseif (Auth::check())
                            <button class="llibre-btn rate me-3 disabled" disabled style="margin-right: 20px">Ja has valorat
                                aquest llibre</button>
                        @endif

                        <a href="{{ url('/llibres') }}" class="llibre-btn back">Tornar al llistat</a>
                    </div>
                </div>
            </div>

            <!-- Valoracions -->
            <div class="col-12 mt-5">
                <div class="card p-4 shadow-sm llibre-card-valoracions">
                    <h3 class="mb-4 llibre-section-title">Valoracions</h3>
                    @forelse ($llibre->llibresValorats as $usuari)
                        @php
                            $estrelles = round($usuari->pivot->nota / 2); // Converteix nota (0-10) a estrelles (0-5)
                        @endphp
                        <div class="mb-3 border-bottom pb-3 valoracio-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $usuari->name }}</strong>
                                    <span class="text-muted"> - {{ $usuari->pivot->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="estrelles">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="estrella {{ $i <= $estrelles ? 'filled' : '' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                            <p class="mt-2">{{ $usuari->pivot->valoracio }}</p>
                        </div>
                    @empty
                        <p class="text-muted">Encara no hi ha valoracions.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Importar Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    /* Contenidor principal */
    .llibre-container {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
        padding: 40px 20px;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    /* Títol del llibre */
    .llibre-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(90deg, #ffd700, #f0ad4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    /* Divisor */
    .divider {
        border-top: 2px solid #e9ecef;
        margin: 20px 0;
    }

    /* Targeta de la imatge */
    .llibre-card-img {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .llibre-card-img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .llibre-img {
        max-height: 400px;
        object-fit: contain;
        background-color: #f5f5f5;
    }

    /* Targeta de detalls */
    .llibre-card-details {
        border: none;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .llibre-info h4 {
        font-size: 1.2rem;
        color: #1e2a44;
        margin-bottom: 10px;
    }

    .llibre-info p {
        font-size: 1rem;
        color: #34495e;
        line-height: 1.6;
    }

    /* Botons */
    .llibre-btn {
        display: inline-block;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        font-weight: 600;
        text-decoration: none;
        border: none;
    }

    .llibre-btn.edit {
        background-color: #f0ad4e;
    }

    .llibre-btn.delete {
        background-color: #d9534f;
    }

    .llibre-btn.rate {
        background-color: #5cb85c;
    }

    .llibre-btn.back {
        background-color: #343a40;
    }

    .llibre-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        text-decoration: none;
    }

    .llibre-btn.disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Targeta de valoracions */
    .llibre-card-valoracions {
        border: none;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .llibre-section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1e2a44;
        background: linear-gradient(90deg, #ffd700, #f0ad4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .valoracio-item {
        transition: background 0.3s ease;
    }

    .valoracio-item:hover {
        background: #f8f9fa;
        border-radius: 8px;
        padding-left: 10px;
    }

    .estrelles {
        display: flex;
        gap: 5px;
    }

    .estrella {
        font-size: 1.2rem;
        color: #d1d5db;
    }

    .estrella.filled {
        color: #f1c40f;
    }

    .text-muted {
        font-size: 0.9rem;
        color: #6b7280;
    }

    /* Alertes */
    .alert-success {
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Responsivitat */
    @media (max-width: 768px) {
        .llibre-title {
            font-size: 2rem;
        }

        .llibre-section-title {
            font-size: 1.5rem;
        }

        .llibre-img {
            max-height: 300px;
        }

        .llibre-info h4 {
            font-size: 1rem;
        }

        .llibre-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>