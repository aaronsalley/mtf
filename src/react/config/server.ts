'use strict';

'use strict';

import bodyParser from 'body-parser';
import cors from 'cors';
import express from 'express';
import helmet from 'helmet';
import logger from 'logger';
import passport from 'passport';
import Raven from 'raven';

import protectedRoutes from '../routes/protectedRoutes';
import publicRoutes from '../routes/publicRoutes';
import connectToDb from './db';

const app = express();
app.use(cors());

connectToDb();

// Sentry connection
Raven.config(process.env.SENTRY_DSN, {
  release: process.env.VERSION,
  tags: {
    component: 'api',
  },
}).install();
app.use(Raven.requestHandler());
app.use(Raven.errorHandler());

// Parse incoming body requests
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
  extended: true,
}));

// Set HTTP headers for safety
app.use(helmet());
app.use(helmet.noCache());

// Authentication
// require('../routes/middlewears/passport');
app.use(passport.initialize());
app.use(passport.session());

// App routes
app.use(publicRoutes);
app.use(protectedRoutes);

// Start Listening
app.listen(process.env.API_PORT, () => logger.info(
    `Listening for requests on port ${process.env.API_PORT}!`,
));
