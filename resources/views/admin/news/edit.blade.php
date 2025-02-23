@extends('admin.layouts.app')

@section('title', 'Izmeni vest')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Izmena vesti</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Naslov vesti</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $news->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Kratak opis</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" 
                                  name="excerpt" 
                                  rows="3"
                                  required>{{ old('excerpt', $news->excerpt) }}</textarea>
                        <div class="form-text">Kratak opis koji će se prikazivati u listi vesti (maksimalno 500 karaktera)</div>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Sadržaj vesti</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" 
                                  name="content" 
                                  rows="10"
                                  required>{{ old('content', $news->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="images" class="form-label">Dodaj još slika</label>
                        <input type="file" 
                               class="form-control @error('images.*') is-invalid @enderror" 
                               id="images" 
                               name="images[]" 
                               accept="image/*"
                               multiple>
                        <div class="form-text">
                            Možete izabrati više slika odjednom.<br>
                            Dozvoljeni formati: JPG, PNG<br>
                            Maksimalna veličina: 2MB po slici
                        </div>
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Istakni vest
                            </label>
                            <div class="form-text">Istaknute vesti se prikazuju na vrhu liste</div>
                        </div>
                    </div>

                    <!-- Postojeće slike -->
                    <div class="mt-4">
                        <h6>Postojeće slike</h6>
                        <div class="row g-2">
                            @foreach($news->images as $image)
                                <div class="col-6">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             class="img-thumbnail" 
                                             alt="Slika vesti">
                                        <div class="form-check position-absolute top-0 end-0 m-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   name="delete_images[]" 
                                                   value="{{ $image->id }}" 
                                                   id="delete_image_{{ $image->id }}">
                                            <label class="form-check-label" 
                                                   for="delete_image_{{ $image->id }}">
                                                Obriši
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="imagePreview" class="mt-4">
                        <!-- JavaScript će ovde prikazati preview novih slika -->
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.news.index') }}" class="btn btn-light">Odustani</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Sačuvaj izmene
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '<h6>Preview novih slika</h6>';
    
    for (const file of this.files) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'mb-2';
            div.innerHTML = `
                <img src="${e.target.result}" 
                     class="img-thumbnail" 
                     style="max-height: 150px;">
            `;
            preview.appendChild(div);
        }
        reader.readAsDataURL(file);
    }
});

// Inicijalizacija CKEditor-a za bogat tekst
if (typeof ClassicEditor !== 'undefined') {
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
}
</script>
@endpush
