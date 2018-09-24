'use strict';

import {
  // ResponsiveMenu,
  // ResponsiveToggle,
  // Sticky,
  Foundation,
} from 'foundation-sites';
import Raven from 'raven-js';
import React from 'react';
import {render} from 'react-dom';
// import Stripe from 'stripe';
import $ from 'jquery';

import Instagram from '../../views/components/gramfeed';

Raven.config(process.env.SENTRY_DSN).install();

(function(w, d, s, l, i) {
  w[l]=w[l]||[]; w[l].push({'gtm.start':
  new Date().getTime(), 'event': 'gtm.js'}); let f=d.getElementsByTagName(s)[0];
  let j=d.createElement(s); let dl=l!='dataLayer'?'&l='+l:''; j.async=true; j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', process.env.GTM_ID);

$(document).foundation();
// const $menu = new Foundation.ResponsiveMenu('#topbar');
// const $menuToggle = new Foundation.ResponsiveToggle('.title-bar', {
//   'hideFor': 'medium',
//   'data-animate': false,
// });
// const $menuSticky = new Foundation.Sticky('#header-bar');


render(
    <Instagram maxItems='50' />
    , document.getElementById('instagram')
);
