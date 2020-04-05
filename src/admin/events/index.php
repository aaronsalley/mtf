<?php 
class Events extends MTF_Admin {
  function __construct(){
    $this->add_new_menu_page();
  }
  
  private function add_new_menu_page(){
    function events(){
      add_menu_page(
        $page_title = 'Events',
        $menu_title = 'Events',
        $capability = 'edit_others_posts',
        $menu_slug = 'mtf_events',
        $function = ' ',
        $icon_url = 'dashicons-tickets-alt',
        $position = 27,
      );
    };
    add_action('admin_menu', 'events');
  }
}