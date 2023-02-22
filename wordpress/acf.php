 <!-- Header and footer field -->
<?php the_field('header_logo', 'option') ?>
<?php get_field('header_logo', 'option') ?>

<!-- Page field -->
<?php the_field('header_logo'); ?>
<?php get_field('header_logo'); ?>

<!-- Image field -->
<!-- Using Image URL -->
<?php the_field('header_logo'); ?>
<!-- Using Image ID -->
<?php
   $banner_butom_image = get_field('banner_butom_image');
   $banner_butom_image_src = wp_get_attachment_image_url($banner_butom_image, 'full');
   $banner_butom_image_alt = get_post_meta($banner_butom_image, '_wp_attachment_image_alt', true);
?>
<img src="<?php echo esc_attr($banner_butom_image_src); ?>" alt="<?php echo esc_attr($banner_butom_image_alt); ?>">

<!-- Using Image Array -->

<?php 
$image = get_field('image');
if( !empty( $image ) ): ?>
    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
<?php endif; ?>


<!-- repeter -->
<?php
   if (have_rows('banner_section')) :
      while (have_rows('banner_section')) : the_row();
?>

      <?php  get_sub_field('image'); ?>  
      <?php  the_sub_field('image'); ?>   
      <!-- img -->
      <?php
      $banner_butom_image = get_field('banner_butom_image');
      $banner_butom_image_src = wp_get_attachment_image_url($banner_butom_image, 'full');
      $banner_butom_image_alt = get_post_meta($banner_butom_image, '_wp_attachment_image_alt', true);
      ?>
      <img src="<?php echo esc_attr($banner_butom_image_src); ?>" alt="<?php echo esc_attr($banner_butom_image_alt); ?>">
<?php
      endwhile;
   endif;
?>


<!-- Checkbox -->
<?php
   $cta_checkbox = get_field('cat_checkbox');
      // var_dump($cta_checkbox);
      foreach ($cta_checkbox as $cta_check) :
         // echo $cta_check['value'];
          if ($cta_check['value'] == 'yes') :
?>
<!-- Content -->
<?php
         endif;
         wp_reset_postdata();
      endforeach;
?>

<!-- file -->
<!-- Basic display (array) -->

<?php
$file = get_field('file');
if( $file ): ?>
    <a href="<?php echo $file['url']; ?>"><?php echo $file['filename']; ?></a>
<?php endif; ?>

<!-- Basic display (ID) -->
<?php
$file = get_field('file');
if( $file ):
    $url = wp_get_attachment_url( $file ); ?>
    <a href="<?php echo esc_html($url); ?>" >Download File</a>
<?php endif; ?>

<!-- Basic display (URL) -->
<?php if( get_field('file') ): ?>
    <a href="<?php the_field('file'); ?>" >Download File</a>
<?php endif; ?>

<!-- link -->
<?php $speakers_button_link = get_field('speakers_button_link'); ?>
<?php if (!empty($speakers_button_link)) { ?>
    <a href=" <?php echo $speakers_button_link; ?> "><?php the_field('speakers_button_title') ?></a>
<?php } ?>