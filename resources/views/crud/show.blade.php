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
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-decoration: underline;
        }
    </style>
    <div class="container mt-5">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="card shadow-sm">
                    <img src="{{ $llibre->imatge }}" class="card-img-top rounded" alt="Imatge del llibre" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <h1 class="display-4" style="color: #ffd700;">{{ $llibre->titol }}</h1>
                    <hr>
                    <h4>Autor: <span class="fw-bold">{{ $llibre->autor }}</span></h4>
                    <h4>Data de publicació: <span class="fw-bold">{{ $llibre->data_publicacio }}</span></h4>
                    <h4>Preu: <span class="fw-bold">{{ number_format($llibre->preu, 2) }} €</span></h4>
                    <h4>Categoria: <span class="fw-bold">{{ $categoria->name ?? 'Sense categoria' }}</span></h4>
                    <p class="mt-3"><strong>Resum:</strong> {{ $llibre->resum }}</p>
                    @if ($llibre->edat_minima)
                        <h4>Edat mínima recomanada: <span class="fw-bold">{{ $llibre->edat_minima }} anys</span></h4>
                    @endif
                    <br>
                    <div class="btn-group" role="group" aria-label="Accions del llibre">
                        @if (Auth::user() && Auth::user()->email == 'admin@admin.es')
                            <a href="{{ url('/llibre/edit/' . $llibre->id) }}" class="llibre-btn edit me-2"
                                style="margin-right: 20px;">
                                Editar el llibre
                            </a>
                            <form action="{{ route('crud.delete', $llibre->id) }}" method="POST"
                                onsubmit="return confirm('Vols eliminar el llibre?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="llibre-btn delete me-2"
                                    style="margin-right: 20px;">Eliminar</button>
                            </form>
                        @endif

                        <!-- Condició per mostrar el botó "Afegir una valoració" -->
                        @if (Auth::check() && !$hasValoracio)
                            <a href="{{ url('/valoracions/create/' . $llibre->id . '/' . auth()->user()->id) }}"
                                class="llibre-btn rate me-2" style="margin-right: 20px;">
                                Afegir una valoració
                            </a>
                        @elseif (Auth::check())
                            <button class="llibre-btn rate me-2"  style="margin-right: 20px;">Ja has valorat aquest llibre</button>
                        @endif

                        <a href="{{ url('/llibres') }}" class="llibre-btn back">
                            Tornar al llistat
                        </a>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card p-4 shadow-sm">
                    <h3 class="mb-4">Valoracions</h3>
                    @forelse ($llibre->llibresValorats as $usuari)
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
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
@endsection