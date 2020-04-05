'use strict';

import $ from 'jquery';
import Foundation from 'foundation-sites';
// import Raven from 'raven-js';

Foundation.addToJquery($);
$(document).foundation();

const manifest = (
  (async () => {
    const wp = await $.ajax('/index.php?rest_route=/');
    const icon = await $('[rel="icon"], [rel="apple-touch-icon-precomposed"], [name="msapplication-TileImage"]');

    let icons = [];
    for (let i = 0; i < icon.length; i++) {
      icons.push({
        'src': icon[i].href !== undefined ? icon[i].href : icon[i].content,
        'size': icon[i].sizes !== undefined ? icon[i].sizes.value : '',
        'type': 'image/png',
      })
    }

    let json = {
      'name': wp.name,
      'short_name': 'MTF',
      'description': wp.description,
      'start_url': wp.url,
      'display': 'standalone',
      'background_color': '#000000',
      'theme_color': '#EA2430',
      'icons': icons,
    }
    const stringyManifest = JSON.stringify(json);
    const blob = new Blob([stringyManifest], { type: 'application/json' });
    const manifestURL = URL.createObjectURL(blob);
    $('#manifest').attr('href', manifestURL);
  })()
);

const topbar = new Foundation.Sticky($('#topbar'), {
  container: '',
  stickyOn: 'small',
  containerClass: 'page',
});

const sidenav = (
  new Foundation.OffCanvas($('#sidenav'), {
    closeOnClick: true,
    contentId: 'app',
    nested: true,
    contentScroll: false,
    isRevealed: true,
    revealOn: 'large',
  }),

  (() => {
    if (Foundation.MediaQuery.atLeast('medium')) {
      new Foundation.DropdownMenu($('#sidenav .menu:first-child'), {})
    } else {
      new Foundation.Drilldown($('#sidenav .menu:first-child'), {})
    }
  })()
);

//Background tricks for single events on really xlarge devices
const single_bg = () => {
  const image = $('.single #tribe-events .tribe-events-event-image');
  const content = $('.single #content');
  const sidenav = $('#sidenav');

  if (Foundation.MediaQuery.atLeast('xlarge') && image) {
    const url = image.children('img').attr('src');
    const marginLeft = (content.outerWidth(true) - content.innerWidth()) / 2;
    return image.width(marginLeft + sidenav.outerWidth(true)).css('background-image', `url(${url})`)
  } else if (image) {
    return image.removeAttr('style');
  }
}
$(window).ready(single_bg);
$(window).resize(sidenav, single_bg);

// TODO: set ticket iframe to content height
// .js-ticket-widget .g-grid .g-grid--page-margin-manual

if (process.env.NODE_ENV == 'production') {
  // Raven.config(process.env.MTF_SENTRY_DSN).install();

  (function (w, d, s, l, i) {
    w[l] = w[l] || []; w[l].push({
      'gtm.start':
        new Date().getTime(), 'event': 'gtm.js'
    }); let f = d.getElementsByTagName(s)[0];
    let j = d.createElement(s); let dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', process.env.MTF_GTM_ID);
}
