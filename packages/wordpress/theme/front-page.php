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
  <?php get_template_part('components/organisms/Event/event', 'grid'); ?>
  <?php get_template_part('components/organisms/ImageGallery/index'); ?>
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
        <span id="roundtables"></span>
        <h3>
          <a href="#roundtables">Roundtables</a>
          <a href="#accordion">Roundtables</a>
        </h3>
        <div>
          <p>These affinity- and accountability-focused monthly writer’s groups invite the broader musical theatre community to share works in progress in a supportive, collaborative environment.</p>
          <a class="button left" href="<?php echo get_the_permalink($programs[2]); ?>">Read More</a>
        </div>
      </li>
      <li>
        <span id="salons"></span>
        <h3>
          <a href="#salons">Factory Salons</a>
          <a href="#accordion">Factory Salons</a>
        </h3>
        <div>
          <p>Factory Salons are themed events where musical theatre creators and general audiences alike can come together to experience new works and engage in critical discourse about the musical theatre industry and form.</p>
          <a class="button left" href="<?php echo get_the_permalink($programs[2]); ?>">Read More</a>
        </div>
      </li>
      <li>
        <span id="4x15"></span>
        <h3>
          <a href="#4x15">4x15™ Rounds</a>
          <a href="#accordion">4x15™ Rounds</a>
        </h3>
        <div>
          <p>4×15™ Rounds empower artists to excavate a section of their work and unlock new discoveries that can inform the piece as it develops.</p>
          <a class="button left" href="<?php echo get_the_permalink($programs[2]); ?>">Read More</a>
        </div>
      </li>
      <li>
        <span id="labs"></span>
        <h3>
          <a href="#labs">Labs</a>
          <a href="#accordion">Labs</a>
        </h3>
        <div>
          <p>In partnership with dramaturgs and MTF artistic staff, these one- to two-week Labs allow artists access to a full team of creatives and actors to deepen their understanding of their new work in a way that enhances their overall impact.</p>
          <a class="button left" href="<?php echo get_the_permalink($programs[2]); ?>">Read More</a>
        </div>
      </li>
      <li>
        <span id="concerts"></span>
        <h3>
          <a href="#concerts">Concert Series</a>
          <a href="#accordion">Concert Series</a>
        </h3>
        <div>
          <p>At venues such as Joe’s Pub at The Public Theater, MTF supports creators by enlisting a full band and actors to showcase their new music.</p>
          <a class="button left" href="<?php echo get_the_permalink($programs[2]); ?>">Read More</a>
        </div>
      </li>
    </ul>
  </div>
  <?php get_template_part('components/organisms/Article/article', 'grid'); ?>
</main>
<?php get_footer(); ?>