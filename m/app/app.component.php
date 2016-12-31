<?php
	class user {
		var $name;
		
		public $first;
		public $last;
		
		function __construct(){
			$this->current_user = wp_get_current_user();
		}
		
		function get_name() {
			if ( is_user_logged_in() ) {
				$name = $this->current_user->name;
			} else {
				$name = null;
			}
	
			return $name;
		}
	}
	
	class blog {
		function article() {
			return get_the_title();
		}
		
		function category() {
			return get_the_terms( $post->ID, 'category' );
		}

		function related() {
			return get_the_terms( $post->ID, 'post_tag', '', ',', ' | ' );
		}
		
		function date() {
			return get_the_date();
		}
	}