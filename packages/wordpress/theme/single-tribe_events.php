<main>
  <header>
    <div><img src='' id="stage" /></div>
    <aside>
      {artists}
      <?php get_template_part('components/the_title'); ?>
      <p>{programService}</p>
      <time>
        <strong>{date}</strong> {time}
      </time>
      <address>
        {locationName ?? 'Online'}
      </address>
      <p>{ticketPrice}</p>
      <button>Find tickets</button>
      <span></span>
    </aside>
  </header>
  <section>
    <h2>Description</h2>
    <div><?php the_content(); ?></div>
  </section>
</main>