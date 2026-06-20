<?php
/**
 * GeneratePress Child Theme
 */

// Remove estilos e scripts dos blocos do WooCommerce
add_action('wp_enqueue_scripts', 'remove_woocommerce_block_assets', 999);
function remove_woocommerce_block_assets() {
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('wc-blocks-style-css');
    wp_dequeue_style('classic-theme-styles');
    
    wp_dequeue_script('wc-blocks-middleware');
    wp_dequeue_script('wc-blocks-data-store');
    wp_dequeue_script('wc-blocks-registry');
    wp_dequeue_script('wc-settings');
    wp_dequeue_script('wc-blocks-shared-context');
    wp_dequeue_script('wc-blocks-shared-hocs');
    wp_dequeue_script('price-format');
}

// Remove os prefetch links do WooCommerce (versão que trata arrays)
add_filter('wp_resource_hints', 'remove_woocommerce_prefetch_hints', 10, 2);
function remove_woocommerce_prefetch_hints($hints, $relation_type) {
    if ('prefetch' === $relation_type) {
        foreach ($hints as $key => $hint) {
            if (is_string($hint) && strpos($hint, 'woocommerce') !== false) {
                unset($hints[$key]);
            } elseif (is_array($hint) && isset($hint['href']) && strpos($hint['href'], 'woocommerce') !== false) {
                unset($hints[$key]);
            }
        }
        $hints = array_values($hints);
    }
    return $hints;
}
// Remove prefetchs do WordPress core (wp-includes/js/dist/)
add_filter('wp_resource_hints', function($hints, $relation_type) {
    if ('prefetch' === $relation_type) {
        foreach ($hints as $key => $hint) {
            if (is_string($hint) && strpos($hint, '/wp-includes/js/dist/') !== false) {
                unset($hints[$key]);
            } elseif (is_array($hint) && isset($hint['href']) && strpos($hint['href'], '/wp-includes/js/dist/') !== false) {
                unset($hints[$key]);
            }
        }
        $hints = array_values($hints);
    }
    return $hints;
}, 10, 2);

?>