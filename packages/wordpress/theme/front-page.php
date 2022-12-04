<?php
$regex = '/<!-- wp:image[\w\d\s\/\.,{};:="<>-]+<!-- \/wp:image -->/';
preg_match($regex, get_the_content(), $images);
print_r($images);
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
    <?php echo preg_replace($regex, '', get_the_content()); ?>
  </section>
  <div class="accordion">
    <?php echo $images[0]; ?>
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