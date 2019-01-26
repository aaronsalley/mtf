'use strict';

import $ from 'jquery';
import FastAverageColor from 'fast-average-color/dist/index.es6';
import Foundation from 'foundation-sites';
import Masonry from 'masonry-layout';
import Raven from 'raven-js';

Foundation.addToJquery($);
$(document).foundation();

const navDrawer = new Foundation.OffCanvas($('#nav-drawer'), {
  transition: 'slide',
  contentId: 'main',
  nested: false,
});

const msnry = new Masonry( '.blog-posts', {
  columnWidth: '.grid-sizer',
  itemSelector: '.post',
  percentPosition: true,
});

const fac = new FastAverageColor();
fac.getColorAsync(document.querySelector('img'), function(color) {
    console.log(color);
});

if (process.env.NODE_ENV == 'production') {
  Raven.config(process.env.SENTRY_DSN).install();

  (function(w, d, s, l, i) {
    w[l]=w[l]||[]; w[l].push({'gtm.start':
    new Date().getTime(), 'event': 'gtm.js'}); let f=d.getElementsByTagName(s)[0];
    let j=d.createElement(s); let dl=l!='dataLayer'?'&l='+l:''; j.async=true; j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', process.env.GTM_ID);
}
