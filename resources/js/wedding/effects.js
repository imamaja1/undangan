document.addEventListener('DOMContentLoaded', () => {
    const particlesContainers = document.querySelectorAll('.particles-container');
    
    particlesContainers.forEach(container => {
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 8 + 6) + 's';
            particle.style.animationDelay = (Math.random() * 10) + 's';
            particle.style.width = (Math.random() * 4 + 2) + 'px';
            particle.style.height = particle.style.width;
            container.appendChild(particle);
        }
    });

    const parallaxEls = document.querySelectorAll('.parallax-bg');
    window.addEventListener('scroll', () => {
        parallaxEls.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const offset = (rect.top / window.innerHeight) * 30;
                el.style.backgroundPositionY = `calc(50% + ${offset}px)`;
            }
        });
    }, { passive: true });
});
