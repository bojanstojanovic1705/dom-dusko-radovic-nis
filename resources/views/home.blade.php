@extends('layouts.app')

@section('title', 'Početna')

@section('content')
<section class="hero-fullscreen">
    <img src="{{ asset('images/hero.jpg') }}" alt="Hero image" class="hero-image">
</section>

<section class="section about-section">
    <div class="container">
        <h2 class="section-title">Ko smo mi?</h2>
        <div class="section-content">
            <p>Дом за децу и омладину је облик институционалне заштите којим се обезбеђује збрињавање деце без одговарајућег родитељског старања као и деце чији је развој ометен породичним приликама. Домским смештајем обезбеђује се нега, старање о здрављу, васпитање, помоћ у образовању и учење различитих социјалних вештина. Смештај у дому је привремен и траје све док то околности захтевају, односно до повратка детета у сопствену породицу, усвојења или оспособљења за самосталан живот.</p>
        </div>
    </div>
</section>

<section class="section cards-section">
    <div class="container">
        <div class="cards-grid">
            <div class="feature-card">
                <h3 class="feature-title">Šta radimo</h3>
                <p class="feature-text">Pružamo sveobuhvatnu brigu i podršku deci bez roditeljskog staranja, obezbeđujući im siguran dom, kvalitetno obrazovanje i emotivnu podršku za zdrav razvoj.</p>
            </div>
            
            <div class="feature-card">
                <h3 class="feature-title">Naša misija</h3>
                <p class="feature-text">Stvaramo podsticajno okruženje koje omogućava deci da razviju svoje potencijale, izgrade samopouzdanje i steknu veštine potrebne za samostalan život.</p>
            </div>
            
            <div class="feature-card">
                <h3 class="feature-title">Naše vrednosti</h3>
                <p class="feature-text">Negujemo individualni pristup svakom detetu, poštujemo različitosti i podstičemo razvoj talenata kroz ljubav, razumevanje i profesionalnu posvećenost.</p>
            </div>
        </div>
    </div>
</section>

<section class="section quotes-section">
    <div class="container">
        <h2 class="section-title">Citati Duška Radovića</h2>
        <div class="swiper quotes-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Дете је недовршен човек, али је човек."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Живот је леп, ако знаш како да га живиш. Ако не знаш како да живиш, питај дете. Оно зна."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Ко не воли децу, није ни сам био дете."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Деца су украс света."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Будите добри према деци, она ће водити свет онда када ви то више не будете могли."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Деца су цвеће живота које расте из наших срца."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Љубав према деци је једина љубав која не тражи ништа заузврат."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"У свакој игри има мудрости."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Деца су наша будућност и наша највећа одговорност."</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="quote-card">
                        <p class="quote-text">"Срећно дете је највеће богатство света."</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section class="section news-section">
    <div class="container">
        <h2 class="section-title">Aktuelnosti</h2>
        <div class="swiper news-slider">
            <div class="swiper-wrapper">
                @foreach($news as $item)
                <div class="swiper-slide">
                    <div class="news-card">
                        <div class="news-card__image">
                            <img src="{{ asset($item->main_image) }}" alt="{{ $item->title }}">
                        </div>
                        <div class="news-card__content">
                            <h3 class="news-card__title">{{ $item->title }}</h3>
                            <p class="news-card__excerpt">{{ $item->excerpt }}</p>
                            <a href="{{ route('news.show', $item->slug) }}" class="news-card__button">Pročitaj više</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

<section class="section impact-section">
    <div class="container">
        <div class="impact-grid">
            <div class="impact-content">
                <h2 class="impact-title">Zajedno možemo više</h2>
                <p class="impact-subtitle">Svako dete zaslužuje priliku za srećno detinjstvo</p>
                
                <div class="impact-stats">
                    <div class="stat-item" data-count="150">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Dece kojima smo pomogli</div>
                    </div>
                    <div class="stat-item" data-count="50">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Aktivnih volontera</div>
                    </div>
                    <div class="stat-item" data-count="95">
                        <div class="stat-number">0</div>
                        <div class="stat-label">% Uspešnih priča</div>
                    </div>
                </div>

                <div class="impact-text">
                    <p>Vaša podrška menja živote. Bilo da se radi o donaciji, volontiranju ili širenju svesti o našoj misiji, svaki doprinos je dragocen.</p>
                </div>

                <div class="impact-actions">
                    <button class="btn btn-primary btn-donate" id="donateBtn">
                        <i class="fas fa-heart"></i>
                        Doniraj
                        <div class="btn-ripple"></div>
                    </button>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-volunteer">
                        <i class="fas fa-hands-helping"></i>
                        Postani volonter
                    </a>
                </div>
            </div>

            <div class="impact-visual">
                <div class="impact-cards">
                    <div class="impact-card">
                        <div class="card-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3>Donacije</h3>
                        <p>Vaša donacija obezbeđuje:</p>
                        <ul>
                            <li>Školski pribor</li>
                            <li>Odeću i obuću</li>
                            <li>Obrazovne materijale</li>
                            <li>Sportsku opremu</li>
                        </ul>
                    </div>
                    <div class="impact-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Volontiranje</h3>
                        <p>Načini na koje možete pomoći:</p>
                        <ul>
                            <li>Mentorstvo</li>
                            <li>Pomoć u učenju</li>
                            <li>Kreativne radionice</li>
                            <li>Organizacija događaja</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Donation Modal -->
<div class="modal" id="donationModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Napravite promenu danas</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="donation-options">
                <div class="donation-intro">
                    <p>Vaša donacija pomaže deci da ostvare svoje snove. Izaberite način donacije koji vam najviše odgovara:</p>
                </div>
                
                <div class="donation-methods">
                    <div class="donation-method">
                        <div class="method-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h3>Bankovni transfer</h3>
                        <div class="bank-details">
                            <p><strong>Primalac:</strong> Dom "Dušan Radović"</p>
                            <p><strong>Broj računa:</strong> 840-XXXXXXXXX-XX</p>
                            <p><strong>Svrha uplate:</strong> Donacija</p>
                        </div>
                    </div>

                    <div class="donation-method">
                        <div class="method-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>Materijalne donacije</h3>
                        <p>Možete donirati:</p>
                        <ul>
                            <li>Školski pribor</li>
                            <li>Knjige</li>
                            <li>Odeću i obuću</li>
                            <li>Igračke</li>
                        </ul>
                        <p class="contact-note">Kontaktirajte nas za više informacija o materijalnim donacijama.</p>
                    </div>
                </div>

                <div class="donation-footer">
                    <p class="tax-note">* Sve donacije su oslobođene poreza prema članu XX Zakona o donacijama.</p>
                    <div class="donation-actions">
                        <a href="{{ route('contact') }}" class="btn btn-outline">
                            <i class="fas fa-envelope"></i>
                            Kontaktirajte nas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quotes slider
    new Swiper('.quotes-slider', {
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
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });

    // News slider
    new Swiper('.news-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 4000,
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
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            }
        }
    });

    // Animacija brojača za statistiku
    const stats = document.querySelectorAll('.stat-item');
    
    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateStats(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    stats.forEach(stat => observer.observe(stat));

    function animateStats(statElement) {
        const targetNumber = parseInt(statElement.dataset.count);
        const numberElement = statElement.querySelector('.stat-number');
        const duration = 2000; // 2 seconds
        const steps = 60;
        const stepDuration = duration / steps;
        let currentNumber = 0;
        
        const increment = targetNumber / steps;
        
        const timer = setInterval(() => {
            currentNumber += increment;
            if (currentNumber >= targetNumber) {
                numberElement.textContent = targetNumber;
                clearInterval(timer);
            } else {
                numberElement.textContent = Math.floor(currentNumber);
            }
        }, stepDuration);
    }

    // Ripple efekat za dugme za donaciju
    const donateBtn = document.querySelector('.btn-donate');
    
    donateBtn.addEventListener('mouseenter', function(e) {
        const ripple = this.querySelector('.btn-ripple');
        ripple.classList.add('active');
    });
    
    donateBtn.addEventListener('mouseleave', function(e) {
        const ripple = this.querySelector('.btn-ripple');
        ripple.classList.remove('active');
    });

    // Modal functionality
    const modal = document.getElementById('donationModal');
    const closeBtn = document.querySelector('.modal-close');

    donateBtn.addEventListener('click', function() {
        modal.classList.add('modal-show');
        document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', function() {
        modal.classList.remove('modal-show');
        document.body.style.overflow = '';
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('modal-show');
            document.body.style.overflow = '';
        }
    });

    // Prevent modal close when clicking inside modal-content
    const modalContent = document.querySelector('.modal-content');
    modalContent.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endpush
