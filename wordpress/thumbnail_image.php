<!-- post & page fetcher image -->
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php
$banner_img = get_post_thumbnail_id();
$banner_img_src = wp_get_attachment_image_url($banner_img, 'Home_page_Banner');
$bannerimgalt = get_post_meta($banner_img, '_wp_attachment_image_alt', true);
?>

<img src="<?php echo esc_attr($banner_img_src); ?>" alt="<?php echo esc_attr($bannerimgalt); ?>" >
<?php endwhile; endif; ?>