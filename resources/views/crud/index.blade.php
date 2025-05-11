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
                <div class="col-xs-6 col-sm-4 col-md-3 text-center llibre-card">
                    <a href="{{ route('crud.show', $llibre->id) }}">
                        <img src="{{$llibre->imatge }}" style="height:200px" />
                        <h4 style="min-height:45px;margin:5px 0 10px 0" id="titol">
                            {{$llibre->titol }}
                        </h4>

                        <!-- Mostrar la mitjana de valoracions amb estil -->
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
                <div class="col-xs-6 col-sm-4 col-md-3 text-center llibre-card">
                    <img src="{{$llibre->imatge }}" style="height:200px" />
                    <h4 style="min-height:45px;margin:5px 0 10px 0" id="titol"> No es pot accedir al llibre:
                        {{$llibre->titol }}
                    </h4>

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
    #titol {
        padding-top: 20px;
    }

    .llibre-card {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
    }

    .llibre-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .llibre-card h4 {
        color: black;
    }

    .llibre-card img {
        border-radius: 5px;
        max-width: 100%;
        height: auto;
    }

    /* Estil per la mitjana de valoracions */
    .valoracio-mitjana {
        padding-top: 10px;
        padding-bottom: 2px;
    }

    /* Nota mitjana destacada */
    .nota-mitjana {
        color: #f39c12;
        font-size: 16px;
        font-weight: bold;
    }

    /* Estils per quan no hi ha valoracions */
    .valoracio-mitjana p.text-muted {
        font-size: 14px;
        color: #7f8c8d;
    }

    /* Efecte visual de la targeta */
    .llibre-card:hover .nota-mitjana {
        color: #d35400;
    }
</style>