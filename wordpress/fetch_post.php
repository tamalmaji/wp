<?php
$featured = new WP_Query(
   array(
      'post_type' => 'project_wdgmedia',
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 1,
      // 'offset' => '1'
      'tax_query' => array(
         array(
            'taxonomy' => 'artical_taxanomy',
            'field' => 'slug',
            'terms' => 'featured',
            'operator' => 'IN',
         )
      )
   )
);

if ($featured->have_posts()) :
   while ($featured->have_posts()) : $featured->the_post();
?>
      <!-- Fetch image -->
      <?php
      $bannrimage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
      $bannerfeatured_img_url = get_post_thumbnail_id();
      $bannerimgalt = get_post_meta($bannerfeatured_img_url, '_wp_attachment_image_alt', true);
      ?>
      <img src="<?php echo $bannrimage[0]; ?>" alt="<?php echo $bannerimgalt; ?>">

      <!-- get Category -->
      <?php
      $terms = get_the_terms($featured->ID, 'category');
      foreach ($terms as $term) :
      ?>
         <a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a>
      <?php endforeach ?>
      <!-- link -->
      <?php the_permalink(); ?>
      <!-- title -->
      <?php the_title(); ?>
      <!--Trim Title -->
      <?php echo wp_trim_words(get_the_title(), 6, '...'); ?>
      <!-- content -->
      <?php the_content(); ?>
      <!--Trim Content -->
      <?php echo wp_trim_words(get_the_content(), 28, '...') ?>
<?php
   endwhile;
   wp_reset_postdata();
endif;
?>