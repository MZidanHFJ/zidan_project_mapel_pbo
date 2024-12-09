// Check if this is the first visit
const isFirstVisit = !sessionStorage.getItem('hasVisited');

// Loading Screen - only on first visit
window.addEventListener('load', () => {
    const loader = document.querySelector('.loader-wrapper');
    
    if (isFirstVisit) {
        setTimeout(() => {
            loader.classList.add('loader-hidden');
            sessionStorage.setItem('hasVisited', 'true');
            
            loader.addEventListener('transitionend', () => {
                loader.remove();
            });
        }, 1500);
    } else {
        loader.remove();
    }
});

// Page Transition Effects
document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.admin-content') || document.querySelector('.container');
    const links = document.querySelectorAll('a');
    
    // Initial page load animation
    if (mainContent) {
        mainContent.classList.add('fade-in');
    }
    
    // Add click event to all links for page transition
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            if (link.href && link.href.startsWith(window.location.origin)) {
                e.preventDefault();
                
                // Fade out current content
                mainContent.classList.remove('fade-in');
                mainContent.classList.add('fade-out');
                
                // Navigate to new page after animation
                setTimeout(() => {
                    window.location.href = link.href;
                }, 300);
            }
        });
    });
});
