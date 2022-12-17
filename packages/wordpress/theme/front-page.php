<?php
$programming = [
  'makers',
  'mtfxr',
  'assemblyline'
];
$programs = [];
foreach ($programming as $service) {
  $programs[] = get_page_by_path($service);
}
MTF_Musicals::logger($programs);
?>

<?php get_header(); ?>
<main class="Home_container">
  <section class="hero">
    <div class="stage">
      <?php the_post_thumbnail('full'); ?>
    </div>
    <aside>
      <span class="scroll-hint">scroll</span>
    </aside>
  </section>
  <blockquote><?php the_excerpt(); ?></blockquote>
  <?php get_template_part('components/event', 'grid'); ?>
  <?php get_template_part('components/image', 'gallery'); ?>
  <section id="programming">
    <?php foreach ($programs as $program) : ?>
      <article>
        <h2><?php echo get_the_title($program); ?></h2>
        <div>
          <p><?php echo get_the_excerpt($program); ?></p>
          <a href="<?php echo get_the_permalink($program); ?>">Learn More</a>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
  <div class="accordion">
    <figure><?php echo get_the_post_thumbnail($programs[2], 'full'); ?></figure>
    <ul>
      <li>R&D</li>
      <li>Factory Salon</li>
      <li>Representation Roundtables</li>
      <li>4x15™ Series</li>
      <li>Labs</li>
      <li>Concert series</li>
      <li>Rolling World Premieres</li>
    </ul>
  </div>
  <?php get_template_part('components/article', 'grid'); ?>
</main>
<?php get_footer(); ?>