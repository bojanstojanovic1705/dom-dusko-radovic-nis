@extends('layouts.app')

@section('title', $news->title)

@section('content')
<section class="section news-detail">
    <div class="container">
        <article class="news-article">
            <header class="news-article__header">
                <h1 class="news-article__title">{{ $news->title }}</h1>
                <time class="news-article__date" datetime="{{ $news->published_at->format('Y-m-d') }}">
                    {{ $news->published_at->format('d.m.Y.') }}
                </time>
            </header>

            @if($news->main_image)
                <div class="news-article__main-image">
                    <img src="{{ asset('storage/' . $news->main_image) }}" 
                         alt="{{ $news->title }}"
                         class="img-fluid">
                </div>
            @endif

            <div class="news-article__content">
                {!! $news->content !!}
            </div>

            @if($news->images->count() > 1)
            <div class="news-article__gallery mt-4">
                <h3>Galerija slika</h3>
                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper">
                        @foreach($news->images as $image)
                            @if($image->image_path !== $news->main_image)
                                <div class="swiper-slide">
                                    <figure class="gallery-item">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             alt="{{ $news->title }}"
                                             class="img-fluid">
                                    </figure>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            @endif

            <footer class="news-article__footer mt-4">
                <a href="{{ route('news.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Nazad na sve vesti
                </a>
            </footer>
        </article>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .news-detail {
        padding: 4rem 0;
    }

    .news-article {
        max-width: 800px;
        margin: 0 auto;
    }

    .news-article__header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .news-article__title {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .news-article__date {
        color: #666;
        font-style: italic;
    }

    .news-article__main-image {
        margin-bottom: 2rem;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .news-article__main-image img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .news-article__content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
        margin-bottom: 3rem;
    }

    .news-article__gallery {
        margin-bottom: 3rem;
    }

    .news-article__gallery h3 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .gallery-slider {
        padding-bottom: 3rem;
    }

    .gallery-item {
        margin: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .gallery-item img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #0056b3;
    }

    .swiper-pagination-bullet {
        background: #0056b3;
    }

    .swiper-pagination-bullet-active {
        background: #003d82;
    }

    .news-article__footer {
        text-align: center;
        margin-top: 3rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.gallery-slider')) {
        new Swiper('.gallery-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    }
});
</script>
@endpush
