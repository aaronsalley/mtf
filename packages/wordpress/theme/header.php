<?php $GOOGLE_TM = getenv('GOOGLE_TM'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <!--[if lt IE 9]>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
    <![endif]-->
  <?php if (!is_user_logged_in()) : ?>
    <script id="gtm">
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', '<?php echo $GOOGLE_TM; ?>');
    </script>
  <?php endif; ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class('mtfmusicals'); ?>>
  <?php if (!is_user_logged_in()) : ?>
    <noscript><iframe src='<?php echo "https://www.googletagmanager.com/ns.html?id=$GOOGLE_TM"; ?>' height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <?php endif; ?>
  <header class="Header_container">
    <div class="appbar">
      <span>
        <div class="brand">
          <?php the_custom_logo(); ?>
        </div>
        <menu class="Menu_mega_container">
          <button><i class="fa-solid fa-bars-staggered"></i></button>
          <?php wp_nav_menu([
            'theme_location' => 'mega',
            'container' => null,
            'fallback_cb' => false
          ]); ?>
        </menu>
      </span>
    </div>
    <?php wp_nav_menu([
      'theme_location' => 'nav',
      'container' => 'nav',
      'container_class' => 'Menu_nav_container',
      'fallback_cb' => false
    ]); ?>
  </header>