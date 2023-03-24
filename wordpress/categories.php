<?php
if ($terms = get_terms(array('taxonomy' => 'product_cat', 'hide_emptyhide_empty' => true, 'order' => 'desc', 'number' => 4))) :
   foreach ($terms as $term) :
      $category_link = get_category_link($term->term_id);
?>
      <div class="col-md-7">
         <a href="<?php echo $category_link; ?>">
            <div class="food_innr">
               <div class="food_img">
                  <?php
                  $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                  $catimg = wp_get_attachment_url($thumbnail_id);
                  ?>
                  <img src="<?php echo $catimg ?>" alt="<?php echo $term->name ?>">
               </div>
               <div class="food_txt">
                  <h4><?php echo $term->name; ?></h4>
               </div>
            </div>
         </a>
      </div>
<?php
   endforeach;
endif;
?>