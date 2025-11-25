jQuery(function($) {
    function bindLocationSelector() {
        // console.log("Binding custom_shipping_location");
        $(document).off('change', '#custom_shipping_location').on('change', '#custom_shipping_location', function () {
            var $spinner = $('<img>', {
                src: '/wp-content/uploads/2025/07/loading.gif', // Path to your loading gif
                class: 'spinner', // Optional class for styling
                style: 'display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; height: 50px; width: 50px;' // Centered on the screen
            });
    
            // Append the spinner to the body
            $spinner.appendTo('body');
    
            // Show the spinner before making the AJAX request
            $spinner.show(); 
    
            var locationID = $(this).val();
            var locationName = $(this).find('option:selected').text(); 
    
            $.ajax({
                url: custom_clc_params.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'custom_check_stock',
                    location_id: locationID
                },
                success: function (response) {
                    // Hide the spinner after the AJAX request is done
                    $spinner.hide();
    
                    if (response.success) {
                        if (response.data.length === 0) {
                            $('#location-stock-response').html('');
                            return; // Exit early
                        }
    
                        var html = '';
                        $.each(response.data, function(index, item) {
                            html += '<div>';
                            if ( locationName == "Select location to collect order" ) {
                                html += '<span>Please select a store for collection. </span>';
                            }
                            else {
                                html += '<span> Invalid items from ' + locationName + ' (' + item.selected_qty + ') </span>';
                            }
                            html += '<div>';
                            html += '<div>';
                            html += '<img src="' + item.product_image + '" alt="' + item.product_name + '"/>';
                            html += '<h5>' + item.product_name + '</h5>';
                            html += '</div>';
                            html += '<span>Out of Stock</span>';
                            html += '</div>';
                            html += '</div>';

                        });
                        $('#location-stock-response').html(html);
                    } else {
                        $('#location-stock-response').html('<p>Something went wrong, Please try again.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    // Hide the spinner on error as well
                    $spinner.hide();
                    console.error("AJAX error:", error);
                }
            });
        });
    }

    bindLocationSelector();

    $(document.body).on('updated_shipping_method updated_checkout updated_cart_totals', function() {
        bindLocationSelector();
    });

    function toggleLocationField() {
        const $selected = $('input[name^="shipping_method"]').filter(':checked');
        const selectedLabel = $('label[for="' + $selected.attr('id') + '"]').text().trim();

        if (selectedLabel === 'Pick up In Store') {
            $('tr.woocommerce-shipping-location').fadeIn();
        } 
        else if ( selectedLabel === 'Online' ) {
            $('tr.woocommerce-shipping-location').fadeOut();
            $.ajax({
                url: custom_clc_params.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'juniors_location_checker',
                    selectedShipping: 'Online',
                },
                success: function (response) {
                    if (response.success) { } 
                    else { }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }
        else {
            $("#shipping_method_0_flat_rate8").trigger("click");
            $.ajax({
                url: custom_clc_params.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'juniors_location_checker',

                },
                success: function (response) {
                    if (response.success) { } 
                    else { }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }
    
    }

    function bindAllEvents() {
        // On shipping method change
        $(document).on('change', 'input[name^="shipping_method"]', toggleLocationField);

        // On WooCommerce updates
        $(document.body).on('updated_checkout updated_shipping_method updated_cart_totals', function () {
            toggleLocationField();
        });

        // Trigger once on initial load
        toggleLocationField();
    }

    // Call it on DOM ready
    bindAllEvents();
    
});