@extends('layouts.master')
@section('title', 'Crear un llibre')

@section('content')
    <style>
        .alert {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 90%;
            max-width: 400px;
            text-align: center
        }
        .alert-danger {
            background-color: #f44336;
            color: white;
        }
    </style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-center">
                        <h2>Alta d'una categoria</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.new') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label"><strong>Nom:</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>


                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-success px-4 py-2">Afegir llibre</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <h3>Categories ja creades: </h3>
                        @foreach ($Categories as $categoria)
                            <h5 style="display: inline-block;">
                                {{ $categoria->name }}@if (!$loop->last) - @endif
                            </h5>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif