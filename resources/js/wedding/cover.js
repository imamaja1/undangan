import dayjs from 'dayjs';

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

    const musicBtn = document.getElementById('musicControl');
    const audio = document.getElementById('bgMusic');
    
    if (musicBtn && audio) {
        musicBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                musicBtn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l5.5-4v14.4l-5.5-4H4a1 1 0 01-1-1v-4.4a1 1 0 011-1h2.5z"/>';
            } else {
                audio.pause();
                musicBtn.classList.add('animate-spin');
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
