@extends('admin.layouts.app')

@section('title', 'Dodaj novu vest')

@push('styles')
<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nova vest</h5>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Naslov vesti</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
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
                                  required>{{ old('excerpt') }}</textarea>
                        <div class="form-text">Kratak opis koji će se prikazivati u listi vesti (maksimalno 500 karaktera)</div>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Sadržaj vesti</label>
                        <div id="toolbar-container"></div>
                        <div id="editor" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</div>
                        <textarea name="content" id="content" style="display: none">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="images" class="form-label">Slike</label>
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
                                   value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Istakni vest
                            </label>
                            <div class="form-text">Istaknute vesti se prikazuju na vrhu liste</div>
                        </div>
                    </div>

                    <div id="imagePreview" class="mt-4">
                        <!-- JavaScript će ovde prikazati preview slika -->
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.news.index') }}" class="btn btn-light">Odustani</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Sačuvaj
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let editor;

    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
        })
        .then(newEditor => {
            editor = newEditor;
            
            // Sync editor content with hidden textarea
            editor.model.document.on('change:data', () => {
                document.querySelector('#content').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });

    // Form validation
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        const content = editor.getData();
        if (!content.trim()) {
            e.preventDefault();
            alert('Sadržaj vesti je obavezan');
            return false;
        }
        document.querySelector('#content').value = content;
    });

    // Preview slika
    document.getElementById('images').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        
        for (const file of this.files) {
            const reader = new FileReader();
            const div = document.createElement('div');
            div.className = 'mb-3';
            
            reader.onload = function(e) {
                div.innerHTML = `
                    <img src="${e.target.result}" 
                         class="img-thumbnail" 
                         style="max-height: 150px;">
                `;
            };
            
            reader.readAsDataURL(file);
            preview.appendChild(div);
        }
    });
});
</script>
@endpush
