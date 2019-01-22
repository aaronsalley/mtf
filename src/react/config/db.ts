'use strict';

import mongoose from 'mongoose';
import logger from 'logger';

mongoose.Promise = global.Promise;

let connectToDb = () => {
  mongoose.connect(`mongodb://${process.env.DB_HOSTNAME}:${process.env.DB_PORT}/${process.env.DB_NAME}`, {
    autoIndex: process.env.DB_INDEXING,
    useNewUrlParser: true,
  })
      .then(() => logger.info('Connected to DB!'))
      .catch((err) => logger.error(err));
};

export default connectToDb;
