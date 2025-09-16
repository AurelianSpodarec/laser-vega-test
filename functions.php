<?php

function vega_enqueue_styles()
{
  wp_enqueue_style('vega-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'vega_enqueue_styles');
