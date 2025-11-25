<?php 
function bornGetLocationNameByID($location_id) {
    $term = get_term($location_id, 'location');
    if (!is_wp_error($term)) {
        $location_name = $term->name;
    } else {
        $location_name = 'Juniors Toyshop';
    }
    return ucwords(strtolower(str_ireplace('Juniors ', '', $location_name)));
}