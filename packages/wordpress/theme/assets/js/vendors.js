'use strict';

import $ from 'jquery';
import Foundation from 'foundation-sites';
import Raven from 'raven-js';

Foundation.addToJquery($);
$(document).foundation();

const topbar = new Foundation.Sticky($('#topbar'), {
  container: '',
  stickyOn: 'small',
  containerClass: 'page',
});

const sidenav = (
  new Foundation.OffCanvas($('#sidenav'), {
    nested: true,
    contentId: 'app',
    isRevealed: true,
    revealOn: 'large',
  }),
  new Foundation.DropdownMenu($('#sidenav .menu:first-child'), {})
);

if (process.env.NODE_ENV == 'production') {
  Raven.config(process.env.SENTRY_DSN).install();

  (function(w, d, s, l, i) {
    w[l]=w[l]||[]; w[l].push({'gtm.start':
    new Date().getTime(), 'event': 'gtm.js'}); let f=d.getElementsByTagName(s)[0];
    let j=d.createElement(s); let dl=l!='dataLayer'?'&l='+l:''; j.async=true; j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', process.env.GTM_ID);
}
