@extends('layouts.master')
@section('title', 'Editar llibre')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-center">
                        <h2>Editar categoria</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $llibre->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label"><strong>Nom: </strong></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $llibre->name) }}" required>
                                </div>


                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">Actualitzar llibre</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection