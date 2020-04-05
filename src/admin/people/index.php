<?php 
class People extends MTF_Admin {
  function __construct(){
    $this->add_new_menu_page();
  }
  
  private function add_new_menu_page(){
    function people(){
      add_menu_page(
        $page_title = 'People',
        $menu_title = 'People',
        $capability = 'edit_others_posts',
        $menu_slug = 'mtf_people',
        $function = ' ',
        $icon_url = 'dashicons-groups',
        $position = 27,
      );
    };
    add_action('admin_menu', 'people');
  }
}