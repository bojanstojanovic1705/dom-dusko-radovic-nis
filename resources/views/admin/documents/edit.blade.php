@extends('admin.layouts.app')

@section('title', 'Izmeni dokument')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Izmena dokumenta</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Naslov dokumenta</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $document->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Opis (opciono)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $document->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">PDF dokument</label>
                        <input type="file" 
                               class="form-control @error('file') is-invalid @enderror" 
                               id="file" 
                               name="file" 
                               accept=".pdf">
                        <div class="form-text">
                            Trenutni fajl: {{ basename($document->file_path) }}<br>
                            Otpremite novi fajl samo ako želite da zamenite postojeći.<br>
                            Maksimalna veličina: 10MB
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategorija</label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" 
                                name="category" 
                                required>
                            <option value="">Izaberite kategoriju</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" 
                                        {{ old('category', $document->category) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Redosled prikazivanja</label>
                        <input type="number" 
                               class="form-control @error('display_order') is-invalid @enderror" 
                               id="display_order" 
                               name="display_order" 
                               value="{{ old('display_order', $document->display_order) }}" 
                               min="0" 
                               required>
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_public" 
                                   name="is_public" 
                                   {{ old('is_public', $document->is_public) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_public">
                                Javno dostupan dokument
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.documents.index') }}" class="btn btn-light">Odustani</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Sačuvaj izmene
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
