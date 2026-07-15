document.addEventListener('DOMContentLoaded', () => {
    const targetEl = document.getElementById('countdownTarget');
    if (!targetEl) return;

    const targetDate = dayjs(targetEl.value);
    if (!targetDate.isValid()) return;

    const daysEl = document.getElementById('countdownDays');
    const hoursEl = document.getElementById('countdownHours');
    const minutesEl = document.getElementById('countdownMinutes');
    const secondsEl = document.getElementById('countdownSeconds');

    function update() {
        const now = dayjs();
        const diff = targetDate.diff(now, 'second');

        if (diff <= 0) {
            if (daysEl) daysEl.textContent = '0';
            if (hoursEl) hoursEl.textContent = '0';
            if (minutesEl) minutesEl.textContent = '0';
            if (secondsEl) secondsEl.textContent = '0';
            return;
        }

        if (daysEl) daysEl.textContent = Math.floor(diff / 86400);
        if (hoursEl) hoursEl.textContent = Math.floor((diff % 86400) / 3600);
        if (minutesEl) minutesEl.textContent = Math.floor((diff % 3600) / 60);
        if (secondsEl) secondsEl.textContent = diff % 60;
    }

    update();
    setInterval(update, 1000);
});
