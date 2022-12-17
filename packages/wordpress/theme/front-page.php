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
          <a class="button left" href="<?php echo get_the_permalink($program); ?>">Learn More</a>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
  <div class="accordion">
    <figure><?php echo get_the_post_thumbnail($programs[2], 'full'); ?></figure>
    <ul id="accordion">
      <li>
        <span id="salons"></span>
        <h3>
          <a href="#salons">Factory Salons</a>
          <a href="#accordion">Factory Salons</a>
        </h3>
        <div>Content</div>
      </li>
      <li>
        <span id="roundtables"></span>
        <h3>
          <a href="#roundtables">Roundtables</a>
          <a href="#accordion">Roundtables</a>
        </h3>
        <div>Content</div>
      </li>
      <li>
        <span id="4x15"></span>
        <h3>
          <a href="#4x15">4x15™ Rounds</a>
          <a href="#accordion">4x15™ Rounds</a>
        </h3>
        <div>Content</div>
      </li>
      <li>
        <span id="labs"></span>
        <h3>
          <a href="#labs">Labs</a>
          <a href="#accordion">Labs</a>
        </h3>
        <div>Content</div>
      </li>
      <li>
        <span id="concerts"></span>
        <h3>
          <a href="#concerts">Concert Series</a>
          <a href="#accordion">Concert Series</a>
        </h3>
        <div>Content</div>
      </li>
      <li>
        <span id="rnd"></span>
        <h3>
          <a href="#rnd">R&D</a>
          <a href="#accordion">R&D</a>
        </h3>
        <div>Content</div>
      </li>
    </ul>
  </div>
  <?php get_template_part('components/article', 'grid'); ?>
</main>
<?php get_footer(); ?>