<?php



// function mytheme_register_blocks() {
//     $blocks = glob(get_template_directory() . '/blocks/*', GLOB_ONLYDIR);

//     foreach ($blocks as $block_dir) {
//         register_block_type($block_dir);
//     }
// }
// add_action('init', 'mytheme_register_blocks');




// function mytheme_enqueue_vite_assets()
// {
//   $vite = 'http://localhost:5173';

//   wp_enqueue_script('vite-client', $vite . '/@vite/client', [], null, true);
//   wp_enqueue_script('main-js', $vite . '/js/main.js', [], null, true);

//   add_filter('script_loader_tag', function ($tag, $handle, $src) {
//     if (in_array($handle, ['vite-client', 'main-js'], true)) {
//       return '<script type="module" src="' . esc_url($src) . '"></script>';
//     }
//     return $tag;
//   }, 10, 3);
// }

// add_action('wp_enqueue_scripts', 'mytheme_enqueue_vite_assets');


// Register theme-based Gutenberg blocks
// function mytheme_register_blocks() {
//     $blocks = glob(get_template_directory() . '/blocks/*', GLOB_ONLYDIR);

//     foreach ($blocks as $block_dir) {
//         register_block_type($block_dir);
//     }
// }
// add_action('init', 'mytheme_register_blocks');


// function mytheme_enqueue_theme_blocks() {
//     wp_enqueue_script(
//         'mytheme-test-block',
//         get_template_directory_uri() . '/blocks/test/index.js',
//         array('wp-blocks','wp-element','wp-editor'), // <--- explicitly list dependencies
//         filemtime(get_template_directory() . '/blocks/test/index.js'),
//         true
//     );
// }
// add_action('enqueue_block_editor_assets', 'mytheme_enqueue_theme_blocks');

// function mytheme_enqueue_theme_blocks() {
//     $blocks_dir = get_template_directory() . '/blocks';
//     $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);

//     foreach ($block_folders as $block_dir) {
//         $index_js = $block_dir . '/index.js';
//         if (file_exists($index_js)) {
//             $handle = 'mytheme-block-' . basename($block_dir);

//             wp_enqueue_script(
//                 $handle,
//                 get_template_directory_uri() . '/blocks/' . basename($block_dir) . '/index.js',
//                 array('wp-blocks', 'wp-element', 'wp-editor'), // required WP globals
//                 filemtime($index_js),
//                 true
//             );
//         }
//     }
// }
// add_action('enqueue_block_editor_assets', 'mytheme_enqueue_theme_blocks');



// function mytheme_enqueue_theme_blocks() {
//     $build_file = get_template_directory() . '/blocks/build/test/index.js';

//     if ( file_exists( $build_file ) ) {
//         wp_enqueue_script(
//             'mytheme-blocks',
//             get_template_directory_uri() . '/blocks/build/test/index.js',
//             array('wp-blocks', 'wp-element', 'wp-editor'),
//             filemtime($build_file),
//             true
//         );
//     }
// }
// add_action('enqueue_block_editor_assets', 'mytheme_enqueue_theme_blocks');



// function mytheme_enqueue_theme_blocks() {
//     $blocks_build_dir = get_template_directory() . '/blocks/build';
    
//     // Get all subdirectories (each block folder)
//     $block_folders = glob($blocks_build_dir . '/*', GLOB_ONLYDIR);

//     foreach ($block_folders as $folder) {
//         $index_js = $folder . '/index.js';
//         if (file_exists($index_js)) {
//             $handle = 'mytheme-block-' . basename($folder);

//             wp_enqueue_script(
//                 $handle,
//                 get_template_directory_uri() . '/blocks/build/' . basename($folder) . '/index.js',
//                 array('wp-blocks', 'wp-element', 'wp-editor'), // required WP globals
//                 filemtime($index_js),
//                 true
//             );
//         }
//     }
// }
// add_action('enqueue_block_editor_assets', 'mytheme_enqueue_theme_blocks');




// function mytheme_register_test_block() {
//     if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
//         wp_register_block_types_from_metadata_collection(
//             get_template_directory() . '/blocks/build',
//             get_template_directory() . '/blocks/build/blocks-manifest.php'
//         );
//     }
// }
// add_action( 'init', 'mytheme_register_test_block' );

// function mytheme_register_blocks() {
//     $blocks = glob( get_template_directory() . '/test-block/*', GLOB_ONLYDIR );

//     foreach ( $blocks as $block_dir ) {
//         if ( file_exists( $block_dir . '/test-block.json' ) ) {
//             register_block_type( $block_dir, [
//                 'render_callback' => function( $attributes ) use ( $block_dir ) {
//                     $attributes = wp_parse_args( $attributes, [
//                         'heading' => '',
//                         'content' => '',
//                         'imageUrl' => '',
//                         'reverse' => false,
//                         'bgColor' => 'transparent'
//                     ] );
//                     include $block_dir . '/render.php';
//                 }
//             ] );
//         }
//     }
// }
// add_action( 'init', 'mytheme_register_blocks' );


// function mytheme_register_blocks() {
//     $blocks = glob( get_template_directory() . '/blocks/build/*', GLOB_ONLYDIR );

//     foreach ( $blocks as $block_dir ) {
//         if ( file_exists( $block_dir . '/block.json' ) ) {
//             register_block_type( $block_dir, [
//                 'render_callback' => function( $attributes ) use ( $block_dir ) {
//                     include $block_dir . '/render.php';
//                 }
//             ] );
//         }
//     }
// }
// add_action( 'init', 'mytheme_register_blocks' );


function mytheme_register_theme_blocks() {
    $blocks_dir = get_template_directory() . '/blocks';

    // Loop through all block folders
    $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);

    foreach ($block_folders as $folder) {
        $build_dir = $folder . '/build';

        // Check if blocks-manifest.php exists
        if (file_exists($build_dir . '/blocks-manifest.php')) {
            // WP 6.8+ optimized registration
            if (function_exists('wp_register_block_types_from_metadata_collection')) {
                wp_register_block_types_from_metadata_collection($build_dir, $build_dir . '/blocks-manifest.php');
                continue;
            }

            // WP 6.7 fallback
            if (function_exists('wp_register_block_metadata_collection')) {
                wp_register_block_metadata_collection($build_dir, $build_dir . '/blocks-manifest.php');
            }

            // fallback register each block manually
            $manifest_data = require $build_dir . '/blocks-manifest.php';
            foreach (array_keys($manifest_data) as $block_type) {
                register_block_type($build_dir . "/{$block_type}");
            }
        }

        // Optional: dynamic render callback if render.php exists
        if (file_exists($folder . '/render.php')) {
            $block_json = json_decode(file_get_contents($folder . '/block.json'), true);
            if (!empty($block_json['name'])) {
                register_block_type($folder, [
                    'render_callback' => function ($attributes) use ($folder) {
                        include $folder . '/render.php';
                    }
                ]);
            }
        }

        // Enqueue editor JS
        $index_js = $folder . '/build/index.js';
        if (file_exists($index_js)) {
            wp_enqueue_script(
                'mytheme-block-' . basename($folder),
                get_template_directory_uri() . '/blocks/' . basename($folder) . '/build/index.js',
                array('wp-blocks', 'wp-element', 'wp-editor'),
                filemtime($index_js),
                true
            );
        }

        // Enqueue block CSS
        $style_css = $folder . '/style.css';
        if (file_exists($style_css)) {
            wp_enqueue_style(
                'mytheme-block-style-' . basename($folder),
                get_template_directory_uri() . '/blocks/' . basename($folder) . '/style.css',
                [],
                filemtime($style_css)
            );
        }
    }
}
add_action('init', 'mytheme_register_theme_blocks');
add_action('enqueue_block_editor_assets', 'mytheme_register_theme_blocks');



// Enqueue frontend Vite assets
function mytheme_enqueue_vite_assets() {
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
