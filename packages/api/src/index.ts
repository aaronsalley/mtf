'use strict';

import bodyParser from 'body-parser';
import cors from 'cors';
import express from 'express';
import helmet from 'helmet';
import logger from 'logger';
import passport from 'passport';
import Raven from 'raven';
import swaggerJSDoc from 'swagger-jsdoc';
import swaggerUi from 'swagger-ui-express';

import connectToDb from './db/dbConnect';
import routes from './routes/index';

const app = express();
app.use(cors());

connectToDb();

/**
 * Sentry connection
 */
Raven.config(process.env.SENTRY_DSN, {
  release: process.env.VERSION,
  tags: {
    component: 'api',
  },
}).install();
app.use(Raven.requestHandler());
app.use(Raven.errorHandler());

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
  extended: true,
}));

// Set HTTP headers for safety
app.use(helmet());
app.use(helmet.noCache());

// Authentication
require('./services/authService.ts');
app.use(passport.initialize());
app.use(passport.session());

// App routes
app.use(routes);

// Fire up Swagger
const swaggerSpec = swaggerJSDoc({
  definition: {
    openapi: '3.0.0',
    info: {
      title: 'Musical Theater Factory',
      version: `${process.env.VERSION}`,
    },
  },
  // Path to the API docs
  apis: [
    './src/routes/**/*.ts',
    './src/db/**/*.ts',
  ],
});
app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerSpec));
app.use('/docs', express.static('.build/docs'));

// Start Listening
app.listen(process.env.API_PORT, () => logger.info(
  `Listening for requests on port ${process.env.API_PORT}!`
));
