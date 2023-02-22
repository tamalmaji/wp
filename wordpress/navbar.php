
<?php wp_nav_menu(array(
  'theme_location' => 'Custom-primary-menu',
  'menu_class' => 'navbar-nav ml-auto',
  'container_class' => 'ml-auto',
  'list_item_class' => 'nav-item',
  'link_class' => 'nav-link'
)); ?>

<?php
// add in function.php
// add custom a class in navbar
function add_menu_link_class($atts, $item, $args)
{
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

// add custom li class in navbar
function add_menu_list_item_class($classes, $item, $args)
{
  if (property_exists($args, 'list_item_class')) {
    $classes[] = $args->list_item_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);
?>
<?php wp_nav_menu(array(
  'theme_location' => 'Custom-primary-menu',
  'menu_class' => 'navbar-nav ml-auto',
)); ?>


<?php
wp_nav_menu(array(
  'theme_location' => 'primary',
  'menu_class' => '',
  'container' => false,
  'list_item_class' => '',
  'link_class' => ''
));
?>