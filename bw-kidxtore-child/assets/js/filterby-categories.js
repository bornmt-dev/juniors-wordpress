
// changes show sidebar to filter by //
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggleLink = document.querySelector('.open-hide-filters-desktop .dropdown-link');

    if (sidebarToggleLink) {
        const textSpan = sidebarToggleLink.querySelector('.text');
        if (textSpan) {
            textSpan.textContent = 'Filter By'; 
        }

        sidebarToggleLink.setAttribute('data-textshow', 'Filter By');
        sidebarToggleLink.setAttribute('data-texthide', 'Hide Filters');
    }
});