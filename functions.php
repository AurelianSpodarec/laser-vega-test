<?php

function mytheme_enqueue_vite_assets()
{
  $vite = 'http://localhost:5173';

  wp_enqueue_script('vite-client', $vite . '/@vite/client', [], null, true);
  wp_enqueue_script('main-js', $vite . '/js/main.js', [], null, true);

  add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (in_array($handle, ['vite-client', 'main-js'], true)) {
      return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
  }, 10, 3);
}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_vite_assets');
