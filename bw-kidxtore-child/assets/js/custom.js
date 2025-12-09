jQuery(document).ready(function($) {
    // Map of terms and their updated labels
    var labels = {
        '0TO18MONTHS': '0 - 18 Months',
        'TWOTOFIVE': '2 - 5 Years',
        'SIXTOEIGHT': '6 - 8 Years',
        'NINETOELEVEN': '9 - 11 Years',
        'TWELVETOSEVENTEEN': '12 - 17 Years',
        'OVER18': '18+ Years'
    };

    // Modify the text for the filter options
    var filterItems = $('ul.list-filter.attribute-type-default.filter_product-age-range li');

    // Sort the filter items based on our desired order
    var order = ['0TO18MONTHS', 'TWOTOFIVE', 'SIXTOEIGHT', 'NINETOELEVEN', 'TWELVETOSEVENTEEN', 'OVER18'];

    filterItems.each(function() {
        var currentText = $(this).find('a').text().trim();

        // If the current text matches one of the values, update the text
        if (labels[currentText]) {
            $(this).find('a').text(labels[currentText]);
        }
    });

    // Reorder the list based on our defined order
    var sortedItems = [];
    order.forEach(function(value) {
        filterItems.each(function() {
            var currentText = $(this).find('a').text().trim();
            if (currentText === labels[value]) {
                sortedItems.push($(this));
            }
        });
    });

    // Append sorted items back to the list
    $('ul.list-filter.attribute-type-default.filter_product-age-range').empty().append(sortedItems);

    function initMobileSlick() {
        if ($(window).width() <= 570) {
            var $tabList = $('.flex-box-header-tab-list-item-e');

            if ($tabList.length && !$tabList.hasClass('slick-initialized')) {
                $tabList.slick({
                    infinite: true,
                    slidesToShow: 1,
                    arrows: false,
                    variableWidth: true,
                    swipeToSlide: true,
                    autoplay: false,
                    speed: 600,
                    centerMode: true,
                    centerPadding: '20px',
                });

                // Center active tab on click
                $tabList.on('click', '.tab-item-wrap', function(e) {
                    var index = $(this).closest('.slick-slide').data('slick-index');
                    $tabList.slick('slickGoTo', index);
                });
            }
        }
    }

    initMobileSlick();

    $(window).on('resize', function() {
        if ($(window).width() <= 570 && !$('.flex-box-header-tab-list-item-e').hasClass('slick-initialized')) {
            initMobileSlick();
        }
    });

    new Swiper('.lego-swiper', {
        slidesPerView: 5,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 5
            }
        }
    });

    new Swiper('.onsale-swiper', {
        slidesPerView: 5,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 5
            }
        }
    });

    let maxTries = 50;
    let tryCount = 0;

    let interval = setInterval(function() {
        let $button = $('#place_order');

        if ($button.length) {
            if ($button.is('button') && $button.text().trim() !== 'Place Order') {
                $button.text('Place Order');
            } else if ($button.is('input') && $button.val() !== 'Place Order') {
                $button.val('Place Order');
            }
        }

        tryCount++;
        if (tryCount >= maxTries) {
            clearInterval(interval);
        }
    }, 200);

    $(document).on('change', '#gift-receipt', function() {
        var isChecked = $(this).is(':checked') ? 'yes' : 'no';

        $.post(wc_cart_params.ajax_url, {
            action: 'set_gift_receipt',
            gift_receipt: isChecked
        });
    });

    var searchText = "No Points Available for this user"; 

    var textElement = $("body").find(":contains('" + searchText + "')");

    if (textElement.length > 0) {
        
        var link = $('<a>', {
            text: 'Sign In', 
            href: '/my-account/',
            target: '_blank',
            style: 'color: #2792D7; text-decoration: underline;' 
        });

        
        textElement.each(function() {
            $(this).append(" ").append(link);
        });
    }
    
    $('#registerform').on('submit', function(e) {
        console.log(" Trigger: registerform");
        e.preventDefault();
        const $form = $(this);
        const formData = $form.serialize();
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            data: formData + '&action=elbzotech_register_user_ajax',
            dataType: 'json',
            success: function(response) {

                console.log(" Response: registerform ");

                if (response.success) {
                    window.location.href = response.redirect || '/my-account/';
                } else {
                    $('.message.register_error')
                        .text(response.data.message)
                        .addClass('visible')
                        .show();
                }
            },
            error: function(xhr, status, error) {
                $('.message.register_error')
                    .text('Something went wrong. Please try again.')
                    .addClass('visible')
                    .show();
            }
        });
    });

    $(document).on('click', '.la.la-close.elbzotech-close-search-form', function () {
        $(".elbzotech-search-form-wrap-global.active").removeClass("active");
    });

    $(document).on('click', function(event) {
        if ( 
            (
                $(event.target).attr('class') == "search-icon-popup"  || 
                $(event.target).attr('class') == "icon icon-search11" || 
                $(event.target).attr('class') == "search-icon-popup-clickable"
            ) 
            ||  $(event.target).closest('.content-form-popup').length > 0 
            ) {
        }
        else {
            $(".elbzotech-search-form-wrap-global.active").removeClass("active");
        }
    });  

});