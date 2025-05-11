@extends('layouts.master')

@section('title', 'Veure llibre')

@section('content')
    <style>
        /* Estils generals per als botons d'accions */
        .llibre-btn {
            display: inline-block;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 14px 34px rgba(0, 0, 0, 0.08);
            font-weight: bold;
            text-decoration: none;
        }

        /* Estils segons el color del botó (opcional, per fer-los consistents) */
        .llibre-btn.edit {
            background-color: #f0ad4e;
        }

        /* groc (editar) */
        .llibre-btn.delete {
            background-color: #d9534f;
        }

        /* vermell (eliminar) */
        .llibre-btn.rate {
            background-color: #5cb85c;
        }

        /* verd (afegir valoració) */
        .llibre-btn.back {
            background-color: #343a40;
        }


        /* Efecte hover */
        .llibre-btn:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-decoration: underline;
        }
    </style>
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
                    <br>
                    <div class="btn-group" role="group" aria-label="Accions del llibre">
                        @if (Auth::user()->email == 'admin@admin.es')
                            <!-- Editar el llibre -->
                            <a href="{{ url('/llibre/edit/' . $llibre->id) }}" class="llibre-btn edit me-2" style="margin-right: 20px;">
                                Editar el llibre
                            </a>

                            <!-- Eliminar el llibre -->
                            <form action="{{ route('crud.delete', $llibre->id) }}" method="POST"
                                onsubmit="return confirm('Vols eliminar el llibre?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="llibre-btn delete me-2" style="margin-right: 20px;">Eliminar</button>
                            </form>
                        @endif

                        <!-- Afegir una valoració -->
                        <a href="{{ url('/valoracio/create/' . $llibre->id) }}" class="llibre-btn rate me-2" style="margin-right: 20px;">
                            Afegir una valoració
                        </a>

                        <!-- Tornar al llistat -->
                        <a href="{{ url('/llibres') }}" class="llibre-btn back">
                            Tornar al llistat
                        </a>
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
        </div>
    </div>
@endsection