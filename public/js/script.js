// Future JavaScript functionality can be added here.

document.addEventListener('DOMContentLoaded', function() {
    console.log('Website loaded and ready.');

    // Add fade-in animation to elements with data-animation on scroll
    const animatedElements = document.querySelectorAll('[data-animation]');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const animationClass = entry.target.dataset.animation;
                const animationDelay = entry.target.dataset.animationDelay;

                if (animationClass) {
                    entry.target.classList.add('animate__animated', animationClass);
                    if (animationDelay) {
                        entry.target.style.animationDelay = animationDelay;
                    }
                }
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(element => {
        observer.observe(element);
    });
});