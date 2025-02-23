@extends('layouts.app')

@section('title', 'Kontakt')

@section('content')
<div class="contact-page">
    <div class="contact-header">
        <h1 class="section-title">Kontaktirajte nas</h1>
        <p class="lead-text">Stojimo vam na raspolaganju za sva pitanja, sugestije ili potrebne informacije.</p>
    </div>

    <div class="contact-container">
        <div class="contact-info">
            <div class="info-card">
                <div class="info-header">
                    <h2>Informacije</h2>
                </div>
                
                <div class="info-items">
                    <div class="info-item" data-aos="fade-right" data-aos-duration="300" data-aos-delay="0">
                        <i class="fa fa-map-marker-alt"></i>
                        <div class="item-content">
                            <h3>Adresa</h3>
                            <p>Gutenbergova 4A, Niš, 18000 Niš</p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-right" data-aos-duration="300" data-aos-delay="50">
                        <i class="fa fa-phone"></i>
                        <div class="item-content">
                            <h3>Telefon</h3>
                            <p><a href="tel:+381182161168">018 216168</a></p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-right" data-aos-duration="300" data-aos-delay="100">
                        <i class="fa fa-envelope"></i>
                        <div class="item-content">
                            <h3>Email</h3>
                            <p><a href="mailto:info@ddradovic.rs">info@domduskoradovic-nis.rs</a></p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-right" data-aos-duration="300" data-aos-delay="150">
                        <i class="fa fa-clock"></i>
                        <div class="item-content">
                            <h3>Radno vreme</h3>
                            <p>Ponedeljak - Petak: 08:00 - 16:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Ime i prezime</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email adresa</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Naslov</label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Poruka</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Pošalji poruku</span>
                </button>
            </form>
        </div>
    </div>

    <div class="contact-map">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1466669.3133127156!2d19.973831525!3d44.112482169574044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4755b0e62f4c6b83%3A0xf7f17fe078b51ecd!2z0JTQvtC8INC30LAg0LTQtdGG0YMg0Lgg0L7QvNC70LDQtNC40L3RgyDigJ7QlNGD0YjQutC-INCg0LDQtNC-0LLQuNGb4oCc!5e0!3m2!1sen!2srs!4v1740337047865!5m2!1sen!2srs"
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@endsection
