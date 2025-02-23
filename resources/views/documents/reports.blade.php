@extends('layouts.app')

@section('title', 'Godišnji izveštaji')

@section('content')
<div class="documents-page">
    <div class="container">
        <header class="documents-header">
            <h1>Godišnji izveštaji</h1>
            <p>Pristupite godišnjim izveštajima ustanove</p>
        </header>

        <div class="documents-grid">
            @forelse($documents as $document)
                <div class="document-card" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="document-icon">
                        <i class="far fa-file-pdf"></i>
                    </div>
                    <div class="document-info">
                        <h3>{{ $document->title }}</h3>
                        @if($document->description)
                            <p>{{ $document->description }}</p>
                        @endif
                    </div>
                    <a href="{{ asset('storage/' . $document->file_path) }}" 
                       class="download-btn" 
                       target="_blank">
                        <i class="fas fa-download"></i>
                        <span>Preuzmi</span>
                    </a>
                </div>
            @empty
                <div class="no-documents">
                    <i class="far fa-folder-open"></i>
                    <p>Trenutno nema dostupnih godišnjih izveštaja.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
