import dayjs from 'dayjs';

function createParticles(containerId, count) {
    const container = document.getElementById(containerId);
    if (!container) return;
    for (let i = 0; i < count; i++) {
        const particle = document.createElement('div');
        particle.classList.add('rose-particle');
        const size = Math.random() * 5 + 2;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.bottom = '-10px';
        particle.style.animationDuration = (Math.random() * 12 + 8) + 's';
        particle.style.animationDelay = (Math.random() * 15) + 's';
        particle.style.opacity = '0';
        container.appendChild(particle);
    }
}

window.openInvitation = function() {
    const cover = document.getElementById('coverSection');
    if (cover) {
        cover.style.transform = 'translateY(-100%)';
        setTimeout(() => {
            cover.style.display = 'none';
            document.body.classList.remove('overflow-hidden');
        }, 1000);
    }
    
    const audio = document.getElementById('bgMusic');
    if (audio) {
        audio.play().catch(() => {});
    }
    
    const musicBtn = document.getElementById('musicControl');
    if (musicBtn) {
        musicBtn.style.display = 'flex';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('overflow-hidden');

    createParticles('coverParticles', 25);
    createParticles('openingParticles', 15);
    createParticles('coupleParticles', 15);
    createParticles('countdownParticles', 20);
    createParticles('rsvpParticles', 15);
    createParticles('footerParticles', 15);

    const musicBtn = document.getElementById('musicControl');
    const audio = document.getElementById('bgMusic');
    
    if (musicBtn && audio) {
        musicBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                musicBtn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l5.5-4v14.4l-5.5-4H4a1 1 0 01-1-1v-4.4a1 1 0 011-1h2.5z"/>';
            } else {
                audio.pause();
                musicBtn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>';
            }
        });
    }
    
    document.addEventListener('visibilitychange', () => {
        if (audio && document.hidden) {
            audio.pause();
        }
    });
});
