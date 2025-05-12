@extends('layouts.master')

@section('title', 'Categoria creada')

@section('content')
    <div class="container py-5">
        <h2>La categoria s'ha creat amb èxit!</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nom:</strong> {{ $newCategory->name }}</li>
            <br>
            <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Tornar al llistat
            </a>
            <br>
            <a href="{{ url('/category/create') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Crear una nova categoria
            </a>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@endsection

