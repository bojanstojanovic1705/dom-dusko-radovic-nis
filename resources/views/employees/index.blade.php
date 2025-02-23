@extends('layouts.app')

@section('title', 'Zaposleni')

@section('content')
<section class="section employees-section">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">Naši zaposleni</h1>
            <p class="section-subtitle">Upoznajte naš tim posvećenih profesionalaca</p>
        </header>

        <div class="row g-4">
            @foreach($employees as $employee)
                <div class="col-md-6 col-lg-4">
                    <div class="employee-card">
                        <div class="employee-card__image">
                            @if($employee->image)
                                <img src="{{ asset('storage/' . $employee->image) }}" 
                                     alt="{{ $employee->name }}"
                                     class="img-fluid">
                            @else
                                <div class="employee-card__no-image">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div class="employee-card__content">
                            <h3 class="employee-card__name">{{ $employee->name }}</h3>
                            <div class="employee-card__position">{{ $employee->position }}</div>
                            
                            @if($employee->bio)
                                <div class="employee-card__bio">
                                    {!! $employee->bio !!}
                                </div>
                            @endif

                            <div class="employee-card__contact">
                                @if($employee->email)
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                    </div>
                                @endif
                                
                                @if($employee->phone)
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.employees-section {
    padding: 5rem 0;
    background-color: #f8f9fa;
}

.section-header {
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
}

.employee-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.employee-card:hover {
    transform: translateY(-5px);
}

.employee-card__image {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
}

.employee-card__image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.employee-card__no-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e9ecef;
    color: #adb5bd;
    font-size: 3rem;
}

.employee-card__content {
    padding: 1.5rem;
}

.employee-card__name {
    font-size: 1.25rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.employee-card__position {
    color: #0056b3;
    font-weight: 600;
    margin-bottom: 1rem;
}

.employee-card__bio {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.employee-card__contact {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
    margin-top: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    color: #666;
    font-size: 0.9rem;
}

.contact-item i {
    width: 20px;
    margin-right: 0.5rem;
    color: #0056b3;
}

.contact-item a {
    color: inherit;
    text-decoration: none;
}

.contact-item a:hover {
    color: #0056b3;
}
</style>
@endpush
