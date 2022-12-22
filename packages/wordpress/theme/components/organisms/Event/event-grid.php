<?php
$events = tribe_get_events([
  'start_date' => 'now'
]);

if ($events) :
?>
  <section id="events">
    <h2>Works In Progress</h2>
    <div>
      <?php foreach ($events as $post) {
        setup_postdata($post);

        get_template_part('components/molecules/Event/event', 'tile');
      } ?>
    </div>
    <a class="button" href="<?php echo get_post_type_archive_link('tribe_events'); ?>">See all Works In Progress</a>
  </section>
<?php
endif;
wp_reset_postdata();
?>