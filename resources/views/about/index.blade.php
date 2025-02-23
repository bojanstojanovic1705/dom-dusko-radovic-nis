@extends('layouts.app')

@section('content')
<!-- Ko smo mi sekcija -->
<section id="ko-smo-mi" class="about-section">
    <div class="container">
        <h2 class="section-title">Ko smo mi</h2>
        <div class="about-content">
            <p class="lead-text">Dom "Dušan Radović" je ustanova sa dugogodišnjom tradicijom brige o deci i mladima. Naša misija je da pružimo sigurno i podsticajno okruženje za razvoj svakog deteta.</p>
            <p>Kroz individualni pristup i posvećenost svakom detetu, stvaramo prostor gde se talenti razvijaju, a snovi ostvaruju. Naš tim stručnjaka svakodnevno radi na unapređenju kvaliteta života naših štićenika.</p>
        </div>
    </div>
</section>

<!-- Zaposleni sekcija -->
<section id="zaposleni" class="team-section">
    <div class="container">
        <h2 class="section-title">Naš tim</h2>
        <div class="team-grid">
            @foreach($employees as $employee)
            <div class="team-card">
                <div class="team-card-image">
                    @if($employee->image)
                        <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->name }}">
                    @else
                        <img src="{{ asset('images/team/placeholder.jpg') }}" alt="{{ $employee->name }}">
                    @endif
                    <div class="team-card-overlay">
                        <div class="contact-info">
                            @if($employee->email)
                            <a href="mailto:{{ $employee->email }}" class="contact-link" data-tooltip="Pošalji email">
                                <i class="fa fa-envelope"></i>
                            </a>
                            @endif
                            @if($employee->phone)
                            <a href="tel:{{ $employee->phone }}" class="contact-link" data-tooltip="Pozovi">
                                <i class="fa fa-phone"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="team-card-content">
                    <h3>{{ $employee->name }}</h3>
                    <p class="position">{{ $employee->position }}</p>
                    @if($employee->bio)
                        <div class="bio">{!! $employee->bio !!}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Istorijat sekcija -->
<section id="istorijat" class="history-section">
    <div class="container">
        <h2 class="section-title">Naš istorijat</h2>
        <div class="timeline">
            <div class="timeline-item" data-year="1995">
                <div class="timeline-content">
                    <h3>Osnivanje Doma</h3>
                    <p>Dom "Dušan Radović" je osnovan sa ciljem da pruži dom deci kojoj je potrebna podrška i briga.</p>
                </div>
            </div>
            <div class="timeline-item" data-year="2005">
                <div class="timeline-content">
                    <h3>Proširenje kapaciteta</h3>
                    <p>Otvoreno je novo krilo zgrade, čime je kapacitet doma udvostručen.</p>
                </div>
            </div>
            <div class="timeline-item" data-year="2015">
                <div class="timeline-content">
                    <h3>Modernizacija</h3>
                    <p>Uvedeni su novi programi podrške i savremene metode rada sa decom.</p>
                </div>
            </div>
            <div class="timeline-item" data-year="2025">
                <div class="timeline-content">
                    <h3>Danas</h3>
                    <p>Nastavljamo sa inovacijama i unapređenjem kvaliteta života naših štićenika.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.team-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

@media (max-width: 1400px) {
    .team-grid {
        grid-template-columns: repeat(3, minmax(250px, 1fr));
        max-width: 1200px;
    }
}

@media (max-width: 1200px) {
    .team-grid {
        grid-template-columns: repeat(2, minmax(250px, 1fr));
        max-width: 800px;
    }
}

@media (max-width: 768px) {
    .team-grid {
        grid-template-columns: minmax(250px, 1fr);
        max-width: 400px;
    }
}

.team-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.team-card:hover {
    transform: translateY(-5px);
}

.team-card-image {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    overflow: hidden;
}

.team-card-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-card:hover .team-card-overlay {
    opacity: 1;
}

.contact-info {
    display: flex;
    gap: 1rem;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 0 1rem;
}

.contact-link {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.contact-link:hover {
    background: #007bff;
    color: white;
    transform: translateY(-3px);
}

.contact-link[data-tooltip]:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 0.5rem;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 0.875rem;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.contact-link:hover[data-tooltip]:before {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(-5px);
}

.team-card-content {
    padding: 1.5rem;
}

.team-card-content h3 {
    margin: 0;
    font-size: 1.25rem;
    color: #333;
}

.team-card-content .position {
    color: #007bff;
    font-weight: 500;
    margin: 0.5rem 0;
}

.team-card-content .bio {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-top: 1rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animacija za timeline
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.5
    });

    timelineItems.forEach(item => {
        observer.observe(item);
    });

    // Glatko skrolovanje do sekcija
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const headerOffset = 100; // Offset za fiksnu navigaciju
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Aktiviranje sekcije u navigaciji na osnovu skrola
    const sections = document.querySelectorAll('section[id]');
    
    window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY + 200;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                document.querySelector(`.dropdown-menu a[href*="${sectionId}"]`)?.classList.add('active');
            } else {
                document.querySelector(`.dropdown-menu a[href*="${sectionId}"]`)?.classList.remove('active');
            }
        });
    });
});
</script>
@endpush
