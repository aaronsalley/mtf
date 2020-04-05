<?php 
class Projects extends MTF_Admin {
  function __construct(){
    $this->add_new_menu_page();
  }
  
  private function add_new_menu_page(){
    function projects(){
      add_menu_page(
        $page_title = 'Projects',
        $menu_title = 'Projects',
        $capability = 'edit_others_posts',
        $menu_slug = 'mtf_projects',
        $function = ' ',
        $icon_url = 'dashicons-awards',
        $position = 27,
      );
    };
    add_action('admin_menu', 'projects');
  }
}