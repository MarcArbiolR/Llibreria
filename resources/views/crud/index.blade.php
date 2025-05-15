@extends('layouts.master')

@section('title', 'Llibreria')

@section('content')

    <h1>Cataleg</h1>
    <br>
    @if($category)
        <h3>Llibres de la categoria: {{ $category->name }}</h3>
    @else
        <h3>Tots els llibres</h3>
    @endif

    <div class="row">
        @foreach($llibres as $llibre)
            @if ($edat > $llibre->edat_minima)
                @php
                    $mitjana = $llibre->valoracions->avg(fn($u) => $u->pivot->nota);
                @endphp
                <div class="llibre-card">
                    <a href="{{ route('crud.show', $llibre->id) }}">
                        <img src="{{ $llibre->imatge }}" alt="{{ $llibre->titol }}" />
                        <h4 id="titol">{{ $llibre->titol }}</h4>
                        <div class="valoracio-mitjana">
                            @if ($mitjana)
                                <p class="nota-mitjana">Nota mitjana: <strong>{{ number_format($mitjana, 1) }}/10</strong></p>
                            @else
                                <p class="text-muted">Sense valoracions</p>
                            @endif
                        </div>
                    </a>
                </div>
            @else
                <div class="llibre-card">
                    <img src="{{ $llibre->imatge }}" alt="{{ $llibre->titol }}" />
                    <h4 id="titol">No es pot accedir al llibre: {{ $llibre->titol }}</h4>
                </div>
            @endif
        @endforeach
    </div>


    <!-- Paginación -->
    <div class="links">
        {{ $llibres->links('pagination::bootstrap-4') }} <!-- Genera los enlaces de paginación -->
    </div>

@endsection

<style>
    /* Estils generals per a la targeta dels llibres */
    /* Estils generals per a la targeta dels llibres */
    .llibre-card {
        border: 1px solid #ddd;
        padding: 15px;
        margin: 10px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
        width: 250px;
        /* Amplada fixa */
        height: 360px;
        /* Alçada fixa */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        /* Comença des de dalt */
        align-items: center;
        /* Centra horitzontalment */
        box-sizing: border-box;
        /* Inclou padding i border en la mida */
        overflow: hidden;
        /* Evita desbordaments */
    }

    .llibre-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .llibre-card img {
        border-radius: 5px;
        width: 100%;
        /* Ocupa l'amplada disponible */
        height: 200px;
        /* Alçada ajustada per encaixar a la targeta */
        object-fit: contain;
        /* Mostra la imatge completa sense retallar */
        margin-bottom: 10px;
        /* Espai sota la imatge */
        background-color: #f5f5f5;
        /* Fons per si la imatge és més petita */
    }

    .llibre-card h4 {
        color: black;
        font-size: 16px;
        margin: 0 0 10px 0;
        min-height: 40px;
        /* Alçada mínima per consistència */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* Limita a 2 línies */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 20px;
        /* Alçada de línia per consistència */
    }

    .valoracio-mitjana {
        font-size: 14px;
        min-height: 40px;
        /* Alçada fixa per a la valoració */
        display: flex;
        align-items: center;
        /* Centra verticalment */
        justify-content: center;
        width: 100%;
    }

    .nota-mitjana {
        color: #f39c12;
        font-size: 16px;
        font-weight: bold;
        margin: 0;
    }

    .valoracio-mitjana p.text-muted {
        font-size: 14px;
        color: #7f8c8d;
        margin: 0;
    }

    .llibre-card:hover .nota-mitjana {
        color: #d35400;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Centra les targetes */
        margin-left: -10px;
        margin-right: -10px;
    }
</style>