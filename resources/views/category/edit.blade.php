@extends('layouts.master')
@section('title', 'Editar categoria')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-center">
                        <h2>Editar categoria</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label "><strong>Nom: </strong></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $category->name) }}" required>
                                </div>


                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">Actualitzar category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show fixed-bottom text-center w-100 mb-0" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="alert"
            aria-label="Tancar"></button>
    </div>
@endif