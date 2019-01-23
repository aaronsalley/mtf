<aside class="off-canvas in-canvas-for-large position-left" id="navDrawer">
  <?php wp_nav_menu(array(
    'menu' => '',
    'menu_id' => 'main-nav',
    'container' => 'nav',
    'container_class' => 'menu',
    'theme_location' => 'primary',
  )); ?>
  <?php wp_nav_menu(array(
    'menu' => '',
    'menu_id' => 'social',
    'container' => null,
    'container_class' => 'menu',
    'theme_location' => 'social',
  )); ?>
</aside>
