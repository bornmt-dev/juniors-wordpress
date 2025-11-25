<?php 

function google_maps_infowindow_shortcode($atts) {
    $atts = shortcode_atts(['store' => ''], $atts, 'google_map_info');
    $store_id = $atts['store'];

    if (!$store_id) return 'Please provide a store ID.';
    $store_post = get_post($store_id);
    if (!$store_post) return 'Store not found.';

    $store_name = esc_js($store_post->post_title);
    $store_description = esc_js($store_post->post_content);
    $latitude = get_post_meta($store_id, 'latitude', true) ?: '37.7749';
    $longitude = get_post_meta($store_id, 'longitude', true) ?: '-122.4194';
    $address = esc_js(get_post_meta($store_id, 'address', true));
    $contact = esc_js(get_post_meta($store_id, 'contact', true));
    $opening_hours = esc_js(get_post_meta($store_id, 'opening_hours', true));

    $featured_image_url = get_the_post_thumbnail_url($store_id, 'large');
    $full_image_url = get_the_post_thumbnail_url($store_id, 'full');

    $map_id = 'map_' . $store_id;
    $function_name = 'initMap_' . $store_id;

    ob_start();
    ?>

    <div id="<?php echo $map_id; ?>" class="map-container"></div>

    <script>
        function <?php echo $function_name; ?>() {
            const map = new google.maps.Map(document.getElementById('<?php echo $map_id; ?>'), {
                zoom: 17,
                center: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> }
            });

            const marker = new google.maps.Marker({
                position: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
                map: map,
                title: "<?php echo $store_name; ?>"
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="infowindow-container">
                        <h3 style="color: rgba(0, 0, 0, 0.90); font-family: 'Inter', Sans-serif; font-size: 14.742px; font-weight: 400; line-height: 26px; letter-spacing: 0.45px;"><?php echo $store_name; ?></h3>
                        <div style="margin-bottom: 10px;">
                            <a href="<?php echo esc_url($full_image_url); ?>" target="_blank" class="lightbox-trigger">
                                <img src="<?php echo esc_url($featured_image_url); ?>" style="width: 100%; height: 150px; object-fit: cover; object-position: center center;  cursor: zoom-in;" />
                            </a>
                        </div>
                        <!--<p><?php //echo $store_description; ?></p>-->
                        <p class="modal-text" style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;"><img src="/wp-content/uploads/2025/06/location-store.svg.svg" alt="Address Icon" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 8px;" /><?php echo $address; ?></p>
                        <p class="modal-text" style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;"><img src="/wp-content/uploads/2025/06/telephone-store.svg.svg" alt="Address Icon" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 8px;" /><?php echo $contact; ?></p>
                        <p class="modal-text" style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;"><img src="/wp-content/uploads/2025/06/time-store.svg.svg" alt="Address Icon" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 8px;" /><?php echo $opening_hours; ?></p>
                    </div>
                `
            });

            infoWindow.open(map, marker);

            
            marker.addListener("mouseover", () => {
                infoWindow.open(map, marker);
            });

            
            document.addEventListener("DOMContentLoaded", function () {
                const closeModalBtn = document.getElementById("close-modal");
                if (closeModalBtn) {
                    closeModalBtn.addEventListener("click", function () {
                        infoWindow.close();
                    });
                }
            });
        }

        window.mapsToInit = window.mapsToInit || [];
        window.mapsToInit.push(<?php echo $function_name; ?>);
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('google_map_info', 'google_maps_infowindow_shortcode');