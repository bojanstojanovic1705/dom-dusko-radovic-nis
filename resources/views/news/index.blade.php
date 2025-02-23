@extends('layouts.app')

@section('title', 'Vesti')

@section('content')
<section class="section news-archive">
    <div class="container">
        <h1 class="section-title">Vesti</h1>
        
        <div class="news-grid">
            @foreach($news as $item)
            <article class="news-card">
                <div class="news-card__image">
                    <img src="{{ asset($item->main_image) }}" alt="{{ $item->title }}">
                </div>
                <div class="news-card__content">
                    <h2 class="news-card__title">{{ $item->title }}</h2>
                    <time class="news-card__date" datetime="{{ $item->published_at->format('Y-m-d') }}">
                        {{ $item->published_at->format('d.m.Y.') }}
                    </time>
                    <p class="news-card__excerpt">{{ $item->excerpt }}</p>
                    <a href="{{ route('news.show', $item->slug) }}" class="news-card__button">Pročitaj više</a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $news->links() }}
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.news-archive {
    padding: 4rem 0;
    background-color: #f8f9fa;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 2rem;
    margin: 2rem 0;
}

@media (min-width: 768px) {
    .news-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .news-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.news-card__date {
    display: block;
    color: #666;
    font-style: italic;
    margin: 0.5rem 0;
    font-size: 0.9rem;
}

.pagination-container {
    margin-top: 3rem;
    display: flex;
    justify-content: center;
}

/* Laravel Pagination Customization */
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 0.25rem;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    color: #0056b3;
    text-decoration: none;
    background: #fff;
    border: 1px solid #dee2e6;
}

.pagination li.active span {
    background: #0056b3;
    color: #fff;
    border-color: #0056b3;
}

.pagination li a:hover {
    background: #e9ecef;
}

.pagination li.disabled span {
    color: #6c757d;
    pointer-events: none;
    background: #fff;
}
</style>
@endpush
