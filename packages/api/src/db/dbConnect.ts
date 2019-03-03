'use strict';

import mongoose from 'mongoose';
import logger from 'logger';

mongoose.Promise = global.Promise;

/**
 * Establish connection to MongoDB
 */
const connectToDb = async () => {
  try {
    await mongoose.connect(`mongodb://${process.env.DB_HOSTNAME}:${process.env.DB_PORT}/${process.env.DB_NAME}`, {
      useNewUrlParser: true,
    });
    logger.info('Connected to DB!');
  } catch (err) {
    logger.error(err);
  }
};

export default connectToDb;
