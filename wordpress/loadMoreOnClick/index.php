<!-- speaker_sec -->
<section class="speaker_sec speaker_page_sec">
   <div class="container">
      <div class="spkr_ttle">
         <h5><?php the_field('speaker_title'); ?></h5>
      </div>
      <div class="spkr_cnct">
         <ul class="rw">
            <?php
            $featured = new WP_Query(
               array(
                  'post_type' => 'speakers',
                  'post_status' => 'publish',
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'posts_per_page' => 3,
                  // 'tax_query' => array(
                  //     array(
                  //         'taxonomy' => 'speakers_taxanomy',
                  //         'field' => 'slug',
                  //         'terms' => 'featured',
                  //         'operator' => 'OUT',
                  //     )
                  // )
               )
            );
            $total_pg = $featured->max_num_pages;
            if ($featured->have_posts()) :
               while ($featured->have_posts()) : $featured->the_post();
            ?>
                  <li class="bsns_loop">
                     <div class="spkr_ttle_cnct">
                        <div class="spkr_img_wrap">
                           <?php
                           $bannrimage = wp_get_attachment_image_src(get_post_thumbnail_id($featured->ID), 'full');
                           $bannerfeatured_img_url = get_post_thumbnail_id();
                           $bannerimgalt = get_post_meta($bannerfeatured_img_url, '_wp_attachment_image_alt', true);
                           ?>
                           <img src="<?php echo $bannrimage[0]; ?>" alt="<?php echo $bannerimgalt; ?>">
                        </div>
                        <h5><?php the_title() ?></h5>
                     </div>
                     <h6><?php the_field('speaker_sub_title'); ?></h6>
                     <p> <?php echo wp_trim_words(get_the_content(), 30, '...') ?></p>
                  </li>
            <?php
               endwhile;
               wp_reset_postdata();
            endif;
            ?>
            <input type="hidden" class="pg" value="1" />
         </ul>
         <div class="viw_more_btn_wrap loader_pic">
            <a href="<?php the_field('speaker_button_link'); ?>"><?php the_field('speaker_button'); ?></a>
         </div>
      </div>
   </div>
</section>
<!-- speaker_sec -->