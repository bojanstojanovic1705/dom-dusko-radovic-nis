<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dom Duško Radović Niš</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar__container">
            <a href="{{ route('home') }}" class="navbar__logo">DOM DUŠKO RADOVIĆ NIŠ</a>
            <ul class="navbar__menu">
                <li><a href="{{ route('home') }}">POČETNA</a></li>
                <li>
                    <a href="{{ route('about.index') }}">O NAMA</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('about.index') }}#ko-smo-mi">KO SMO MI</a></li>
                        <li><a href="{{ route('about.index') }}#zaposleni">ZAPOSLENI</a></li>
                        <li><a href="{{ route('about.index') }}#istorijat">ISTORIJAT CENTRA</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">DOKUMENTA</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('documents.reports') }}">GODIŠNJI IZVEŠTAJI</a></li>
                        <li><a href="{{ route('documents.procurement') }}">JAVNE NABAVKE</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news.index') }}">VESTI</a></li>
                <li><a href="{{ route('contact') }}">KONTAKT</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-gradient"></div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Dom Dušan Radović Logo" class="footer-logo-img">
                    </div>
                    <p class="footer-description">
                        Dom "Dušan Radović" je mesto gde svako dete može da pronađe svoj put ka srećnom detinjstvu i svetloj budućnosti.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-links">
                    <h3>Brzi linkovi</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Početna</a></li>
                        <li><a href="{{ route('about.index') }}">O nama</a></li>
                        <li><a href="{{ route('news.index') }}">Vesti</a></li>
                        <li><a href="{{ route('contact') }}">Kontakt</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h3>Kontakt informacije</h3>
                    <ul>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Gunbergova 4a, Niš</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+381 21 123 456</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@domduskoradovic-nis.rs</span>
                        </li>
                    </ul>
                </div>

                <div class="footer-newsletter">
                    <h3>Budite u toku</h3>
                    <p>Prijavite se na naš newsletter i budite prvi koji će saznati naše novosti.</p>
                    <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Vaša email adresa" required>
                            <button type="submit" class="btn-subscribe">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; {{ date('Y') }} Dom "Dušan Radović". Sva prava zadržana.</p>
                </div>
                <div class="footer-legal">
                    <a href="{{ route('legal.privacy') }}">Pravila privatnosti</a>
                    <a href="{{ route('legal.terms') }}">Uslovi korišćenja</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
</body>
</html>
