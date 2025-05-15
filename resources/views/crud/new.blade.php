@extends('layouts.master')

@section('title', 'Llibre creat')

@section('content')
    <div class="container py-5">
        <h2>El llibre ha estat creat amb èxit!</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Títol:</strong> {{ $newLlibre->titol }}</li>
            <li class="list-group-item"><strong>Autor:</strong> {{ $newLlibre->autor }}</li>
            <li class="list-group-item"><strong>Resum:</strong> {{ $newLlibre->resum }}</li>
            <li class="list-group-item"><strong>Data de publicació:</strong> {{ $newLlibre->data_publicacio }}</li>
            <li class="list-group-item"><strong>Preu:</strong> {{ $newLlibre->preu }}</li>
            <li class="list-group-item"><strong>Edat mínima:</strong> {{ $newLlibre->edat_minima }}</li>
            <li class="list-group-item">
                <strong>Categoria:</strong> {{ $categoria->name }}
            </li>
            <li class="list-group-item"><strong>Imatge:</strong> <img src="{{ $newLlibre->imatge }}" alt="Imatge"
                    width="200"></li> <br>
            <a href="{{ url('/llibres') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Tornar al llistat
            </a> <br>
            <a href="{{ url('/llibre/create') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Crear un nou llibre
            </a>

        </ul>
    </div>
@endsection