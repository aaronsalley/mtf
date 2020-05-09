<?php 
get_header();

if( have_posts() ) : while( have_posts() ): the_post();
  the_content();
endwhile; endif;
get_template_part( 'template-parts/events-grid' );
get_template_part( 'template-parts/news-grid' );

get_footer();