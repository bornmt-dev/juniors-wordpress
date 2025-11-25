// jQuery(document).ready(function($) {
//     $('body').on('change', '.qty', function() {
//         var $input = $(this);
//         var cartItemKey = $input.attr('name').match(/\[([a-z0-9]+)\]/i)[1];
//         var quantity = $input.val();

//         $.ajax({
//             type: 'POST',
//             url: custom_cart_ajax.ajax_url,
//             data: {
//                 action: 'update_cart_quantity_checkout',
//                 cart_item_key: cartItemKey,
//                 quantity: quantity
//             },
//             success: function(response) {
//                 if (response.success) {
//                     location.reload();
//                 } else {
//                     alert(response.data.message);
//                 }
//             }
//         });
//     });
// });