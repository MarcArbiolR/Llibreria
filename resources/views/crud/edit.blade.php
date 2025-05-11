@extends('layouts.master')
@section('title', 'Editar llibre')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-center">
                        <h2>Editar llibre</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('crud.update', $llibre->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="titol" class="form-label"><strong>Títol</strong></label>
                                    <input type="text" class="form-control" id="titol" name="titol"
                                           value="{{ old('titol', $llibre->titol) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="autor" class="form-label"><strong>Autor</strong></label>
                                    <input type="text" class="form-control" id="autor" name="autor"
                                           value="{{ old('autor', $llibre->autor) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="data_publicacio" class="form-label"><strong>Data de publicació</strong></label>
                                    <input type="date" class="form-control" id="data_publicacio" name="data_publicacio"
                                           value="{{ old('data_publicacio', $llibre->data_publicacio) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="imatge" class="form-label"><strong>Imatge (URL)</strong></label>
                                    <div class="row g-2 align-items-start">
                                        <div class="col-8">
                                            <input type="url" class="form-control" id="imatge" name="imatge"
                                                   value="{{ old('imatge', $llibre->imatge) }}"
                                                   placeholder="https://exemple.com/imatge.jpg" required>
                                        </div>
                                        <div class="col-1 text-end">
                                            <img id="preview" src="{{ $llibre->imatge }}" alt="Previsualització"
                                                 style="max-width: 200px; height: auto;"
                                                 class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="preu" class="form-label"><strong>Preu</strong></label>
                                    <input type="number" step="0.01" class="form-control" id="preu" name="preu"
                                           value="{{ old('preu', $llibre->preu) }}" required placeholder="0.00€">
                                </div>

                                <div class="col-md-6">
                                    <label for="edat_minima" class="form-label"><strong>Edat mínima</strong></label>
                                    <input type="number" class="form-control" id="edat_minima" name="edat_minima"
                                           value="{{ old('edat_minima', $llibre->edat_minima) }}" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="resum" class="form-label"><strong>Resum</strong></label>
                                    <textarea class="form-control" id="resum" name="resum" rows="4" required>{{ old('resum', $llibre->resum) }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="categoria_id" class="form-label"><strong>Categoria</strong></label>
                                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                                        <option value="" disabled>Selecciona una categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('categoria_id', $llibre->categoria_id) == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
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

    <script>
        document.getElementById('imatge').addEventListener('input', function () {
            const url = this.value.trim();
            const img = document.getElementById('preview');
            img.src = url;
            img.style.display = url ? 'block' : 'none';
        });
    </script>
    
@endsection
