@extends('layouts.app')

@section('title', 'Dokumenta')

@section('content')
<div class="documents-page">
    <div class="container">
        <header class="documents-header">
            <h1>Dokumenta</h1>
            <p>Pristupite važnim dokumentima i informacijama</p>
        </header>

        <div class="documents-nav">
            <div class="categories-wrapper">
                @foreach($categories as $category)
                    <a href="#{{ Str::slug($category) }}" 
                       class="category-link"
                       data-aos="fade-right" 
                       data-aos-delay="{{ $loop->iteration * 100 }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>

        @foreach($categories as $category)
            <section id="{{ Str::slug($category) }}" class="document-section">
                <h2 class="section-title">{{ $category }}</h2>
                <div class="documents-grid">
                    @forelse($documents[$category] as $document)
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
                            <p>Trenutno nema dostupnih dokumenata u kategoriji {{ $category }}.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    html {
        scroll-behavior: smooth;
    }
    
    .document-section {
        margin-bottom: 4rem;
        scroll-margin-top: 2rem;
    }
    
    .section-title {
        color: #2c3e50;
        font-size: 1.8rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(0, 212, 255, 0.2);
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(44,62,80,1) 28%, rgba(0,212,255,1) 100%);
    }
</style>
@endpush
