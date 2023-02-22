function custom_columns( $columns ) {
  $columns = array(
      'cb' => '<input type="checkbox" />',
      'title' => 'Title',
      'featured_image' => ' Feature Image',
      'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
      'date' => 'Date'
   );
  return $columns;
}
add_filter('manage_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) {
  switch ( $column ) {
  case 'featured_image':
      the_post_thumbnail( 'thumbnail' );
      break;
  }
}
add_action( 'manage_posts_custom_column' , 'custom_columns_data', 10, 2 );      