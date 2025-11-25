jQuery(function($) {
    if ( $("body").hasClass("woocommerce-checkout") ) {
        $('body').on('change', '.gift-wrap-field input[type="number"]', function() {
                const $input = $(this);
                let wrapQty = parseInt($input.val(), 10) || 0;
                const maxQty = parseInt($input.attr('max'), 10) || 0;
                const cartItemKey = $input.attr('name').match(/\[(.*?)\]/)[1]; // extract key

                // Prevent exceeding max quantity
                if (wrapQty > maxQty) {
                    wrapQty = maxQty;
                    $input.val(maxQty); // reset the input value visually
                }

                // Prevent negative values
                if (wrapQty < 0) {
                    wrapQty = 0;
                    $input.val(0);
                }

                $.ajax({
                    type: 'POST',
                    url: juniorsGiftWrap.ajax_url,
                    data: {
                        action: 'update_gift_wrap_qty',
                        nonce: juniorsGiftWrap.nonce,
                        cart_item_key: cartItemKey,
                        wrap_qty: wrapQty
                    },
                    beforeSend: function() {
                        $('.woocommerce-checkout-review-order-table').addClass('updating');
                    },
                    success: function(response) {
                        if (response.success) {
                            // Refresh checkout totals
                            $(document.body).trigger('update_checkout');
                        } else if (response.data && response.data.message) {
                            alert(response.data.message);
                        }
                    },
                    complete: function() {
                        $('.woocommerce-checkout-review-order-table').removeClass('updating');
                    }
                });
            });

            $('body').on('click', '.jgw-plus, .jgw-minus', function() {
                const $btn = $(this);
                const $container = $btn.closest('.jgw-container');
                const $input = $container.find('input[type="number"]');

                let current = parseInt($input.val(), 10) || 0;
                const min = parseInt($input.attr('min'), 10) || 0;
                const max = parseInt($input.attr('max'), 10) || 0;

                if ($btn.hasClass('jgw-plus') && current < max) {
                    current++;
                } else if ($btn.hasClass('jgw-minus') && current > min) {
                    current--;
                }

                $input.val(current).trigger('change');
            });
    }
});
