@extends('layouts.master')

@section('title', 'Llibreria')

@section('content')

    <div class="container py-5">
        <h1 class="text-center mb-4">Cataleg de Categories</h1>

        <div class="row">
            @if($categories->isEmpty())
                <div class="col-12 text-center">
                    <p class="alert alert-warning">No hi ha categories disponibles.</p>
                </div>
            @else
                @foreach($categories as $category)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card llibre-card shadow-lg">
                            <div class="card-body text-center">
                                <a href="{{ route('category.edit', $category->id) }}" class="text-decoration-none">
                                    <h4 class="card-title" style="font-size: 1.25rem; font-weight: 600; color: #333;">
                                        {{ $category->name }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links('pagination::bootstrap-4') }} <!-- Genera els enllaços de paginació -->
        </div>
    </div>

@endsection
@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif


<style>
    .llibre-card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .llibre-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: #007bff;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .card-title:hover {
        color: #0056b3;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 50px;
        padding: 8px 16px;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        color: white;
    }
</style>