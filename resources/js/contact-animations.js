document.addEventListener('DOMContentLoaded', () => {
    // Funkcija za proveru da li je element vidljiv
    const isElementInViewport = (el) => {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    };

    // Funkcija za animiranje elemenata
    const animateElements = () => {
        const elements = document.querySelectorAll('[data-aos]');
        
        elements.forEach(element => {
            if (isElementInViewport(element)) {
                element.classList.add('aos-animate');
            }
        });
    };

    // Inicijalno pokretanje animacija
    animateElements();

    // Pokretanje animacija na scroll
    window.addEventListener('scroll', animateElements);
    
    // Animacija za submit dugme
    const submitBtn = document.querySelector('.submit-btn');
    if (submitBtn) {
        submitBtn.addEventListener('mouseover', () => {
            const icon = submitBtn.querySelector('i');
            icon.style.transform = 'translateX(5px)';
        });
        
        submitBtn.addEventListener('mouseout', () => {
            const icon = submitBtn.querySelector('i');
            icon.style.transform = 'translateX(0)';
        });
    }

    // Animacija za info items
    const infoItems = document.querySelectorAll('.info-item');
    infoItems.forEach(item => {
        item.addEventListener('mouseover', () => {
            const icon = item.querySelector('i');
            icon.style.transform = 'scale(1.1)';
        });
        
        item.addEventListener('mouseout', () => {
            const icon = item.querySelector('i');
            icon.style.transform = 'scale(1)';
        });
    });
});
