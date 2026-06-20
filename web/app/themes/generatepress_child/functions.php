<?php
/**
 * GeneratePress Child Theme functions
 */

// Remove os prefetchs e scripts de bloco do WooCommerce
add_action('wp_enqueue_scripts', 'remove_woocommerce_block_assets', 999);
function remove_woocommerce_block_assets() {
    // Desregistra os estilos dos blocos
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('wc-blocks-style-css');
    wp_dequeue_style('classic-theme-styles');
    
    // Desregistra os scripts dos blocos
    wp_dequeue_script('wc-blocks-middleware');
    wp_dequeue_script('wc-blocks-data-store');
    wp_dequeue_script('wc-blocks-registry');
    wp_dequeue_script('wc-settings');
    wp_dequeue_script('wc-blocks-shared-context');
    wp_dequeue_script('wc-blocks-shared-hocs');
    wp_dequeue_script('price-format');
}

// Remove os prefetch links gerados pelo WordPress
add_filter('wp_resource_hints', function($hints, $relation_type) {
    if ('prefetch' === $relation_type) {
        $hints = array_filter($hints, function($hint) {
            return strpos($hint, 'woocommerce') === false;
        });
    }
    return $hints;
}, 10, 2);
?>