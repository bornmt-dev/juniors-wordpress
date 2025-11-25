<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package htvietnam
 */
?>
<?php echo bzotech_get_template('footer-default');?>
<?php echo bzotech_get_template('scroll-top');?>
<?php 
// echo bzotech_get_template('wishlist-notification');
?>
<?php echo bzotech_get_template('tool-panel');?>
<?php echo bzotech_get_template('footer-after');?>
</div>

<?php wp_footer(); ?>
<script>
jQuery(document).ready(function($) {
    // Close when clicking the close button
    $(document).on('click', '.la.la-close.elbzotech-close-search-form', function () {
        // console.log( $(this) );
        $(".elbzotech-search-form-wrap-global.active").removeClass("active");
    });
    $(document).on('click', function(event) {
        // console.log($(event.target).attr('class'));
        if ( ($(event.target).attr('class') == "search-icon-popup" || $(event.target).attr('class') == "icon icon-search11") || $(event.target).closest('.content-form-popup').length > 0 ) {
            // console.log('Clicked INSIDE .content-form-popup');
        }
        else {
            // console.log('Clicked OUTSIDE .content-form-popup');
            $(".elbzotech-search-form-wrap-global.active").removeClass("active");
        }
    });    
});
</script>
</body>
</html>