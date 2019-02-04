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

(function blogFader() {
  const fac = new FastAverageColor();
  const blogPosts = document.querySelector('.blog-posts');
  const articleImages = blogPosts.querySelectorAll('img');

  let stylesheet = document.createElement('style');
      stylesheet.appendChild(document.createTextNode(""));
      document.head.appendChild(stylesheet);
      stylesheet = stylesheet.sheet;

  let i = 0;

  articleImages.forEach(function(image) {
    i++;

    fac.getColorAsync(image, function(color) {
      const regExp = /post-([0-9]+)/;
      const postID = regExp.exec(this.closest('.post').className);
      const target = '.' + postID[0] + ' .image::before';
      const from = 'rgba(' + color.value[0] + ',' + color.value[1] + ',' + color.value[2] + ',0)';
      const to = 'rgba(' + color.value[0] + ',' + color.value[1] + ',' + color.value[2] + ',1)';

      let style = 'background-image: -webkit-gradient(linear, left top, left bottom, from(' + from + '), to(' + to + ')) !important; background-image: linear-gradient(top, ' + from + ' 0%, ' + to + ' 100%) !important;';

      return stylesheet.addRule(target, style);
    });
  });
})();

if (process.env.NODE_ENV == 'production') {
  Raven.config(process.env.SENTRY_DSN).install();

  (function(w, d, s, l, i) {
    w[l]=w[l]||[]; w[l].push({'gtm.start':
    new Date().getTime(), 'event': 'gtm.js'}); let f=d.getElementsByTagName(s)[0];
    let j=d.createElement(s); let dl=l!='dataLayer'?'&l='+l:''; j.async=true; j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', process.env.GTM_ID);
}
