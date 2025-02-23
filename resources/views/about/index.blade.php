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
            <!-- Kartica 1 -->
            <div class="team-card">
                <div class="team-card-image">
                    <img src="{{ asset('images/team/member1.jpg') }}" alt="Marko Marković">
                    <div class="team-card-overlay">
                        <div class="contact-info">
                            <a href="mailto:marko@ddradovic.rs" class="contact-link" data-tooltip="Pošalji email">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <a href="tel:+381641234567" class="contact-link" data-tooltip="Pozovi">
                                <i class="fa fa-phone"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="team-card-content">
                    <h3>Marko Marković</h3>
                    <p class="position">Direktor</p>
                </div>
            </div>

            <!-- Kartica 2 -->
            <div class="team-card">
                <div class="team-card-image">
                    <img src="{{ asset('images/team/member2.jpg') }}" alt="Ana Anić">
                    <div class="team-card-overlay">
                        <div class="contact-info">
                            <a href="mailto:ana@ddradovic.rs" class="contact-link" data-tooltip="Pošalji email">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <a href="tel:+381641234568" class="contact-link" data-tooltip="Pozovi">
                                <i class="fa fa-phone"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="team-card-content">
                    <h3>Ana Anić</h3>
                    <p class="position">Psiholog</p>
                </div>
            </div>

            <!-- Kartica 3 -->
            <div class="team-card">
                <div class="team-card-image">
                    <img src="{{ asset('images/team/member3.jpg') }}" alt="Petar Petrović">
                    <div class="team-card-overlay">
                        <div class="contact-info">
                            <a href="mailto:petar@ddradovic.rs" class="contact-link" data-tooltip="Pošalji email">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <a href="tel:+381641234569" class="contact-link" data-tooltip="Pozovi">
                                <i class="fa fa-phone"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="team-card-content">
                    <h3>Petar Petrović</h3>
                    <p class="position">Socijalni radnik</p>
                </div>
            </div>
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
