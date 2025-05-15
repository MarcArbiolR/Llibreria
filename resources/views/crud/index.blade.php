@extends('layouts.master')

@section('title', 'Llibreria')

@section('content')
    <div class="catalog-container">
        <h1 class="catalog-title">Catàleg de Llibres</h1>
        @if($category)
            <h3 class="category-subtitle">Llibres de la categoria: {{ $category->name }}</h3>
        @else
            <h3 class="category-subtitle">Tots els llibres</h3>
        @endif

        <div class="row">
            @foreach($llibres as $llibre)
                <div class="llibre-card">
                    @if ($edat > $llibre->edat_minima)
                        @php
                            $mitjana = $llibre->valoracions->avg(fn($u) => $u->pivot->nota);
                            $estrelles = $mitjana ? round($mitjana / 2) : 0; // Converteix nota (0-10) a estrelles (0-5)
                        @endphp
                        <a href="{{ route('crud.show', $llibre->id) }}" class="llibre-link">
                            <img src="{{ $llibre->imatge }}" alt="{{ $llibre->titol }}" class="llibre-img" />
                            <h4 class="llibre-title">{{ $llibre->titol }}</h4>
                            <div class="valoracio-mitjana">
                                @if ($mitjana)
                                    <div class="estrelles">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="estrella {{ $i <= $estrelles ? 'filled' : '' }}">&#9733;</span>
                                        @endfor
                                        <p class="nota-mitjana">({{ number_format($mitjana, 1) }}/10)</p>
                                    </div>
                                @else
                                    <p class="text-muted">Sense valoracions</p>
                                @endif
                            </div>
                        </a>
                    @else
                        <img src="{{ $llibre->imatge }}" alt="{{ $llibre->titol }}" class="llibre-img" />
                        <h4 class="llibre-title">No es pot accedir: {{ $llibre->titol }}</h4>
                        <div class="valoracio-mitjana">
                            <p class="text-muted">Restringit per edat</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Paginació -->
        <div class="pagination-links">
            {{ $llibres->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
<style>
    /* Estils generals del contenidor */
    .catalog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f9f9f9 0%, #e8ecef 100%);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Títols */
    .catalog-title {
        font-family: 'Poppins', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .category-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: #34495e;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Disposició de les targetes */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    /* Estils de les targetes */
    .llibre-card {
        background: #ffffff;
        border: none;
        padding: 15px;
        margin: 0;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        width: 250px;
        height: 360px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        box-sizing: border-box;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .llibre-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .llibre-img {
        border-radius: 8px;
        width: 100%;
        height: 200px;
        object-fit: contain;
        background-color: #f5f5f5;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .llibre-card:hover .llibre-img {
        transform: scale(1.05);
    }

    .llibre-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .llibre-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0 0 10px 0;
        min-height: 40px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 20px;
    }

    .valoracio-mitjana {
        font-family: 'Poppins', sans-serif;
        font-size: 0.875rem;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .estrelles {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .estrella {
        font-size: 1rem;
        color: #d1d5db;
        transition: color 0.3s ease;
    }

    .estrella.filled {
        color: #f1c40f;
    }

    .nota-mitjana {
        color: #7f8c8d;
        font-size: 0.875rem;
        margin-left: 5px;
    }

    .text-muted {
        color: #7f8c8d;
        font-size: 0.875rem;
        margin: 0;
    }

    .llibre-card:hover .nota-mitjana {
        color: #e67e22;
    }

    /* Paginació */
    .pagination-links {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        font-family: 'Poppins', sans-serif;
        background: #ffffff;
        border: 1px solid #ddd;
        color: #2c3e50;
        padding: 10px 15px;
        margin: 0 5px;
        border-radius: 8px;
        transition: background 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    .pagination .page-link:hover {
        background: #3498db;
        color: #ffffff;
        border-color: #3498db;
        transform: scale(1.1);
    }

    .pagination .page-item.active .page-link {
        background: #3498db;
        border-color: #3498db;
        color: #ffffff;
    }

    .pagination .page-item.disabled .page-link {
        background: #f5f5f5;
        color: #7f8c8d;
        border-color: #ddd;
    }

    /* Responsivitat */
    @media (max-width: 768px) {
        .catalog-title {
            font-size: 2rem;
        }

        .category-subtitle {
            font-size: 1.2rem;
        }

        .llibre-card {
            width: 200px;
            height: 320px;
        }

        .llibre-img {
            height: 180px;
        }

        .llibre-title {
            font-size: 0.9rem;
            min-height: 36px;
            line-height: 18px;
        }

        .valoracio-mitjana {
            min-height: 36px;
        }
    }
</style>