<?php
/*SPEAKER load more function.php*/
/*ajaxurl*/
add_action('wp_head', 'ajaxurlpolicy');
function ajaxurlpolicy()
{
?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php }

/*Load More for Gallery list page*/
add_action('wp_ajax_nopriv_ajax_wdgmedia_policy_project', 'policy_news_ajax_pagination');
add_action('wp_ajax_ajax_wdgmedia_policy_project', 'policy_news_ajax_pagination');
function policy_news_ajax_pagination()
{

	$policy_pg_next = $_REQUEST['page'] + 1;
	// echo $total_pg;

	$featured = new WP_Query(
		array(
			'post_type' => 'speakers',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 3,
			'paged' => $policy_pg_next
		)
	);
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
				<p><?php echo wp_trim_words(get_the_content(), 30, '...') ?></p>
			</li>
	<?php
		endwhile;
		wp_reset_postdata();
	endif;
	?>
	<input type="hidden" class="pg" value="<?php echo $policy_pg_next; ?>" />
<?php
	die();
}
