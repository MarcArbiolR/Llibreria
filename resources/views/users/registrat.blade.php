@extends('layouts.master')

@section('title', 'Usuari creat')

@section('content')
    <div class="container py-5">
        <h2>L'usuari ha estat creat amb èxit!</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nom:</strong> {{ $user->name }}</li>
            <li class="list-group-item"><strong>Correu electrònic:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Data de naixement:</strong> {{ $user->data_naixement }}</li>
            <li class="list-group-item">
                <a href="{{ route('crud.index') }}" class="btn btn-outline-primary btn-lg mt-3">
                    <i class="bi bi-arrow-left"></i> Tornar al llistat
                </a>
            </li>
        </ul>
    </div>
@endsection