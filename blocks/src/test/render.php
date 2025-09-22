<?php
$heading    = $attributes['heading'] ?? '';
$subheading = $attributes['subheading'] ?? '';
$content    = $attributes['content'] ?? '';
$buttonText = $attributes['buttonText'] ?? '';
$buttonUrl  = $attributes['buttonUrl'] ?? '';
$imageUrl   = $attributes['imageUrl'] ?? '';
$reverse    = $attributes['reverse'] ?? false;
$bgColor    = $attributes['bgColor'] ?? 'transparent';

$flexDir = $reverse ? 'lg:flex-row-reverse lg:pl-28' : 'lg:flex-row lg:pr-28';
?>
<div class="fiftyfifty-img-txt-block mb-20 md:mb-32 xl:mb-48" style="background-color:<?php echo esc_attr($bgColor); ?>">
  <div class="px-8 mx-auto max-w-7xl md:px-11 xl:px-14">

    <div class="flex flex-wrap lg:items-center lg:flex-nowrap justify-between flex-col-reverse <?php echo esc_attr($flexDir); ?>">
      
      <!-- TEXT -->
      <div class="w-full lg:w-1/2 mt-12 md:mt-16 lg:mt-0 color-auto">
        <?php if ($subheading) : ?>
          <p class="heading sub-heading text-dark text-left"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        
        <?php if ($heading) : ?>
          <h2 class="heading h4 !text-red text-left"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php echo wp_kses_post($content); ?>

        <?php if ($buttonText && $buttonUrl) : ?>
          <p>
            <a href="<?php echo esc_url($buttonUrl); ?>" class="btn text-xl rounded-full font-semibold inline-block no-underline py-3 px-6 mt-6 mr-3.5" style="color:#fff;background-color:#d90000">
              <?php echo esc_html($buttonText); ?>
            </a>
          </p>
        <?php endif; ?>
      </div>

      <!-- IMAGE -->
      <?php if ($imageUrl) : ?>
        <div class="relative self-start w-full lg:w-1/2 image-container">
          <img src="<?php echo esc_url($imageUrl); ?>" alt="<?php echo esc_attr($heading); ?>" class="relative lazy" loading="lazy" />
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
