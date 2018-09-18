'use strict';

import axios from 'axios';
import Raven from 'raven-js';
import React, {Component} from 'react';
import {render} from 'react-dom';

import Instagram from '../../views/components/gramfeed';

Raven.config(process.env.SENTRY_DSN).install();

if (process.NODE_ENV == 'production') {
  (function(w, d, s, l, i) {
    w[l]=w[l]||[]; w[l].push({'gtm.start':
  new Date().getTime(), 'event': 'gtm.js'}); let f=d.getElementsByTagName(s)[0];


    let j=d.createElement(s); let dl=l!='dataLayer'?'&l='+l:''; j.async=true; j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', process.env.GTM_ID);
}

render(
    <Instagram maxItems='100' />
    , document.getElementById('instagram')
);
