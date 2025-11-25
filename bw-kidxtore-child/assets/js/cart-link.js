jQuery(document).ready(function($) {
    // This code will now redirect the '.mini-cart-link' to the cart page on click.
    $('body').on('click', '.mini-cart-link', function(e) {
        e.preventDefault(); // Prevents the browser's default link behavior (e.g., if it's an <a> tag)
        e.stopPropagation(); // Stops the click event from "bubbling up" to parent elements

        // Redirects the user to your specified cart page URL
        window.location.href = 'https://juniors.com.mt/cart/';
    });
});