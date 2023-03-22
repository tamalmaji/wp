<?php

/**
 * Plugin Name: Filter Post Type 
 * Plugin URI: https://github.com/WebDevStudios/custom-post-type-ui/
 * Description: Filter Post Type
 * Author URI: https://webdevstudios.com/
 */



// Exit if accessed directly.
if (!defined('ABSPATH')) {
   exit;
}
////custom post type///////////////
function test_post_type()
{
   $labels = array(
      'name'                => __('Network'),
      'singular_name'       => __('Network'),
      'menu_name'           => __('Network'),
      'parent_item_colon'   => __('Parent Network'),
      'all_items'           => __('All Network'),
      'view_item'           => __('View Network'),
      'add_new_item'        => __('Add New Network'),
      'add_new'             => __('Add New'),
      'edit_item'           => __('Edit Network'),
      'update_item'         => __('Update Network'),
      'search_items'        => __('Search Network'),
      'not_found'           => __('Not Found'),
      'not_found_in_trash'  => __('Not found in Trash')
   );
   $args = array(
      'label'               => __('Network'),
      'description'         => __('Network'),
      'labels'              => $labels,
      'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats', 'page-attributes', 'trackbacks'),
      'taxonomies'          => array('genres'),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 32,
      'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post'
   );
   register_post_type('test_cpt', $args);
}
add_action('init', 'test_post_type', 0);
// Testimonial category
add_action('init', 'test_taxonomies', 0);
function test_taxonomies()
{
   $labels = array(
      'name'              => _x('Network categories', 'taxonomy general name'),
      'singular_name'     => _x('Network category', 'taxonomy singular name'),
      'search_items'      => __('Search categories'),
      'all_items'         => __('All Network categories'),
      'parent_item'       => __('Parent Network category'),
      'parent_item_colon' => __('Parent Network category:'),
      'edit_item'         => __('Edit Network category'),
      'update_item'       => __('Update Network category'),
      'add_new_item'      => __('Add New Network category'),
      'new_item_name'     => __('New Network category Name'),
      'menu_name'         => __('Network category'),
   );
   $args = array(
      'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'update_count_callback' => 'my_update_test_category',
      'query_var'         => true,
      'rewrite'           => array('slug' => 'test-category'),
      'supports'          => array('thumbnail'),
   );
   register_taxonomy('test-category', array('test_cpt'), $args);
}
function my_update_test_category($terms, $taxonomy)
{
   global $wpdb;
   foreach ((array) $terms as $term) {
      $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term));
      do_action('edit_term_taxonomy', $term, $taxonomy);
      $wpdb->update($wpdb->term_taxonomy, compact('count'), array('term_taxonomy_id' => $term));
      do_action('edited_term_taxonomy', $term, $taxonomy);
   }
}
/////////////////////////////////////shortcode//////////////////////////////////////////
add_shortcode('searchfilter', 'app_wordpress_plugin_demo');
function app_wordpress_plugin_demo($atts)
{ ?>
   <section class="bnr_alt abut_bnr banner">
      <div class="container">
         <div class="heading_main text-center">
            <h1>TAS Early Career Research (ECR) Network</h1>
         </div>
      </div>
   </section>
   <!--Banner End-->
   <!--About Section-->
   <section class="abutUs_sec">
      <div class="container">
         <div class="global_heading">
            <h2><?php the_title(); ?></h2>
         </div>

         <div class="sldrNav_cntnr">
            <div class="sldrNav_hldr">
               <ul class="sldrNav">
                  <?php while (the_repeater_field('about_section_tab_block')) : ?>
                     <li><a href="javascript:void(0);" class="sldr_nav_anchr"><?php the_sub_field('title'); ?></a></li>
                  <?php endwhile; ?>
               </ul>
            </div>
            <div class="inbtns">
            </div>
         </div>
         <div class="global_heading">
            <h2><?php the_sub_field('team_heading'); ?></h2>
         </div>
         <div class="search_outer">
            <div class="contact_form_innr contact_form_filter">
               <!--       <form method="get" role="search" action="javascript:void(0)">
                              <div class="form-row">
                                  <input type="search" value="" class="form-control" placeholder="Name, Research Discipline, Research Interest, Institution, Affiliation (Hub/Node)" name="s" id="s" required="required" />
                              </div>
                              <div class="sbmt_btn_contact">
                                  <input type="submit" value="Search" name="search_submit" class="basic_btn sub_btn" />
                              </div>
                              </form> -->
               <?php
               $terms = get_terms(array(
                  'taxonomy' => 'test-category',
                  'hide_emptyhide_empty' => true,
                  'order' => 'desc',
                  'parent'   => 0
               ))
               ?>
               <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" id="filter">
                  <div class="row">

                     <div class="col-md-4 ">
                        <label>Researcher Name:</label>
                        <input type="text" name="serchfilter" id="keyword" placeholder="Researcher Name" class="form-control ecr_researcher_name" autocomplete="off">
                     </div>
                     <?php $i = 1; ?>
                     <?php foreach ($terms as $term) : ?>
                        <div class="col-md-4">
                           <!-- Start -->
                           <?php
                           $term_name = $term->name;
                           if ($term_name == "Affiliation (Hub/Node)") {
                           ?>
                              <label><?php echo $term_name; ?>: <i class="fa fa-info-circle" title="Use 'Hub','Node' or state specific Node"></i></label>
                           <?php  } else {  ?>
                              <label><?php echo $term_name; ?>:</label>
                           <?php   }  ?>
                           <!-- End  -->
                           <select type="text" name="categoryfilter_<?php echo $i; ?>" id="cfilter_<?php echo $i; ?>" class="form-control select2">
                              <?php echo $parentId = $term->term_id  ?>
                              <?php $childrens = get_terms([
                                 'taxonomy' => 'test-category',
                                 'hide_emptyhide_empty' => true,
                                 'order' => 'desc',
                                 'parent'   => $parentId
                              ]); ?>
                              <option value="">Select category</option>
                              <?php foreach ($childrens as $children) : ?>
                                 <option value="<?php echo $children->term_id; ?>"><?php echo $children->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <?php $i++; ?>
                     <?php endforeach; ?>
                     <div class="col-md-4">
                        <button class="basic_btn sub_btn  custom_empty">Apply filter</button>
                     </div>
                     <input type="hidden" name="action" value="myfilter">
                  </div>
               </form>
            </div>
            <div class="search_loader" style="display: none;">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/LoaderIcon.png">
            </div>
         </div>
         <div class="abutSldr_main_cntnt" id="response" style="justify-content:center;">
            <?php $j = 1;
            $delay = "";
            //while ( have_rows('about_section_team_block') ) : the_row();  
            $ecrargs = array(
               'post_type' => 'test_cpt',
               'posts_per_page' => -1,
               'post_status' => 'publish'
            );
            $products = new WP_Query($ecrargs);
            if ($products->have_posts()) {
               while ($products->have_posts()) {
                  $products->the_post();

                  if (($j == 1) || ($j == 5) || ($j == 9)) {
                     $delay = "abutCrcl1";
                  }
                  if (($j == 2) || ($j == 6) || ($j == 10)) {
                     $delay = "abutCrcl2";
                  }
                  if (($j == 3) || ($j == 7) || ($j == 11)) {
                     $delay = "abutCrcl3";
                  }
                  if (($j == 4) || ($j == 8) || ($j == 12)) {
                     $delay = "abutCrcl4";
                  }
                  $pstid = get_the_ID();
            ?>
                  <?php
                  $img_src_team = wp_get_attachment_image_url(get_post_thumbnail_id(), 'team-thumb');
                  $img_alt_team = get_post_meta($icons_image, '_wp_attachment_image_alt', true);
                  ?>
                  <div class="abutBox">
                     <div class="abutBox_innr">
                        <?php if ($img_src_team) { ?>
                           <div class="abutUsr_outr_crcle <?php echo $delay; ?>">
                              <div class="abutUsr_innr_crcle">
                                 <img src="<?php echo $img_src_team; ?>" alt="<?php echo $img_alt_team; ?>" />
                              </div>
                           </div>
                        <?php } else { ?>
                           <div class="abutUsr_outr_crcle <?php echo $delay; ?>">
                              <div class="abutUsr_innr_crcle">
                                 <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no_img.jpg" alt="" />
                              </div>
                           </div>
                        <?php } ?>
                        <div class="abutUsr_dtls text-center">
                           <h4><?php the_title(); ?></h4>
                           <div class="abutUsr_dtls_txt">
                              <?php the_field('institution'); ?>
                              <p class="contnt_btn" id="more_btn<?php echo $pstid; ?>">More <span><i class="fas fa-sort-down"></i></span></p>
                              <div class="more_text_innr<?php echo $pstid; ?>">
                                 <p><?php the_field('research_discipline'); ?></p>
                                 <p><?php the_field('research_interest'); ?></p>
                                 <h6><?php the_field('affiliation_hubnode'); ?></h6>
                                 <p class="contnt_btn" id="less_btn<?php echo $pstid; ?>">Less <span><i class="fas fa-sort-up"></i></span></p>
                              </div>
                              <script>
                                 jQuery(document).ready(function($) {
                                    $('.more_text_innr<?php echo $pstid ?>').hide();

                                    $('#more_btn<?php echo $pstid ?>').click(function() {
                                       $('.more_text_innr<?php echo $pstid ?>').show();
                                       $('#more_btn<?php echo $pstid ?>').hide();
                                       //$('#less_btn<?php echo $pstid ?>').hide();
                                    });

                                    $('#less_btn<?php echo $pstid ?>').click(function() {
                                       $('.more_text_innr<?php echo $pstid ?>').hide();
                                       //$('#less_btn<?php echo $pstid ?>').hide();
                                       $('#more_btn<?php echo $pstid ?>').show();
                                    });
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                  </div>

            <?php $j++;
               }
               wp_reset_postdata();
            } ?>
         </div>



      </div>
   </section>
   <?php
}
/////////////////////////////////////shortcode//////////////////////////////////////////
////////////////////////////////////include scripts






add_action('wp_enqueue_scripts', 'selects_more_script');
function selects_more_script()
{
   wp_enqueue_script('select_js', plugin_dir_url(__FILE__) . 'assets/js/selectfilter.js', array('jquery'), '', true);
   wp_localize_script('select_js', 'ajax_posts', array('ajaxurl' => admin_url('admin-ajax.php'),));
}


////////////////////////////////////ajax filterfunctions//////////////////////////////////
add_action('wp_ajax_myfilter', 'products_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'products_filter_function');

function products_filter_function()
{
   $serchfilter = $_POST['serchfilter'];
   $args = array(
      'post_type' => 'test_cpt',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $serchfilter
   );

   if (!empty($_POST['categoryfilter_1']) || !empty($_POST['categoryfilter_2']) || !empty($_POST['categoryfilter_3']) || !empty($_POST['categoryfilter_4'])) {

      $relation = 'OR';
      $args['tax_query'] = array(
         'relation' => $relation,
         array(
            'taxonomy' => 'test-category',
            'field' => 'id',
            'terms' => $_POST['categoryfilter_1']
         ),
         array(
            'taxonomy' => 'test-category',
            'field' => 'id',
            'terms' => $_POST['categoryfilter_2'],
         ),
         array(
            'taxonomy' => 'test-category',
            'field' => 'id',
            'terms' => $_POST['categoryfilter_3'],
         ),
         array(
            'taxonomy' => 'test-category',
            'field' => 'id',
            'terms' => $_POST['categoryfilter_4'],
         )

      );
   }
   $query = new WP_Query($args);

   if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post(); ?>
         <div class="abutBox">
            <div class="abutBox_innr">
               <?php
               $img_src_team = wp_get_attachment_image_url(get_post_thumbnail_id(), 'team-thumb');
               $img_alt_team = get_post_meta($icons_image, '_wp_attachment_image_alt', true);
               ?>
               <?php if ($img_src_team) { ?>
                  <div class="abutUsr_outr_crcle <?php echo $delay; ?>">
                     <div class="abutUsr_innr_crcle">
                        <img src="<?php echo $img_src_team; ?>" alt="<?php echo $img_alt_team; ?>" />
                     </div>
                  </div>
               <?php } else { ?>
                  <div class="abutUsr_outr_crcle <?php echo $delay; ?>">
                     <div class="abutUsr_innr_crcle">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no_img.jpg" alt="" />
                     </div>
                  </div>
               <?php } ?>
               <div class="abutUsr_dtls text-center">
                  <h4><?php the_title(); ?></h4>
                  <div class="abutUsr_dtls_txt">
                     <?php the_field('institution'); ?>
                     <p class="contnt_btn" id="more_btn<?php echo $pstid; ?>">More <span><i class="fas fa-sort-down"></i></span>
                     </p>
                     <div class="more_text_innr<?php echo $pstid; ?>">
                        <p><?php the_field('research_discipline'); ?></p>
                        <p><?php the_field('research_interest'); ?></p>
                        <h6><?php the_field('affiliation_hubnode'); ?></h6>
                        <p class="contnt_btn" id="less_btn<?php echo $pstid; ?>">Less <span><i class="fas fa-sort-down"></i></span></p>
                     </div>
                     <script>
                        jQuery(document).ready(function($) {
                           $('.more_text_innr<?php echo $pstid ?>').hide();

                           $('#more_btn<?php echo $pstid ?>').click(function() {
                              $('.more_text_innr<?php echo $pstid ?>').show();
                              $('#more_btn<?php echo $pstid ?>').hide();
                              //$('#less_btn<?php echo $pstid ?>').hide();
                           });

                           $('#less_btn<?php echo $pstid ?>').click(function() {
                              $('.more_text_innr<?php echo $pstid ?>').hide();
                              //$('#less_btn<?php echo $pstid ?>').hide();
                              $('#more_btn<?php echo $pstid ?>').show();
                           });
                        });
                     </script>
                  </div>
               </div>
            </div>
         </div>
<?php
      endwhile;
      wp_reset_postdata();
   else :
      // echo '<div style="justify-content: center">No posts found</div>';
      echo 'No posts found';
   // echo '<p style="justify-content:center;">A red paragraph.</p>';
   endif;
   die();
}
//////selectpicker///////////////////////////////////////////////////
add_action('wp_enqueue_scripts', 'tasscripts');
function tasscripts()
{
   wp_enqueue_style('developers-css', plugin_dir_url(__FILE__) . '/assets/css/developers.css', array(), '1.0', 'all');
   wp_enqueue_style('selectpicker-css', plugin_dir_url(__FILE__) . '/assets/css/select.css', array(), '1.0', 'all');
   wp_enqueue_script('selectpicker-js', plugin_dir_url(__FILE__) . '/assets/js/selectpicker.js', array('jquery'), 1.1, true);
   wp_enqueue_script('selecttick-js', plugin_dir_url(__FILE__) . '/assets/js/selecttick.js', array('jquery'), 1.1, true);
   wp_enqueue_script('sweetalert2-js', plugin_dir_url(__FILE__) . '/assets/js/sweetalert2.js', array('jquery'), 1.1, true);
}
