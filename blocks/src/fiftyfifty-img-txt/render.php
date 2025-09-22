<?php
$heading    = $attributes['heading'] ?? '';
$subheading = $attributes['subheading'] ?? '';
$content    = $attributes['content'] ?? '';
$buttonText = $attributes['buttonText'] ?? '';
$buttonUrl  = $attributes['buttonUrl'] ?? '';
$imageUrl   = $attributes['imageUrl'] ?? '';
$reverse    = $attributes['reverse'] ?? false;
$bgColor    = $attributes['bgColor'] ?? 'transparent';
$flexDir = $reverse ? 'lg:flex-row-reverse' : 'lg:flex-row';
?>

<div class="fiftyfifty-img-txt-block mb-20" style="background-color: <?php echo esc_attr($bgColor); ?>">
    <div class="flex <?php echo esc_attr($flexDir); ?>">
        <div class="w-1/2">
            <?php if ($subheading) : ?><p><?php echo esc_html($subheading); ?></p><?php endif; ?>
            <?php if ($heading) : ?><h2><?php echo esc_html($heading); ?></h2><?php endif; ?>
            <?php echo wp_kses_post($content); ?>
            <?php if ($buttonText && $buttonUrl) : ?>
                <a href="<?php echo esc_url($buttonUrl); ?>" class="btn"><?php echo esc_html($buttonText); ?></a>
            <?php endif; ?>
        </div>
        <?php if ($imageUrl) : ?>
            <div class="w-1/2">
                <img src="<?php echo esc_url($imageUrl); ?>" alt="<?php echo esc_attr($heading); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>
