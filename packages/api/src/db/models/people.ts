'use strict';

import logger from 'logger';
import mongoose from 'mongoose';

/**
 * @swagger
 *
 * components:
 *  schemas:
 *   Person:
 *    type: object
 *    required:
 *    - username
 *    properties:
 *      name:
 *        type: string
 *        enum: [project, person]
 *        description: Name of the entity type. Autoset by the API.
 *      first_name:
 *        type: string
 *        description: Person's given name.
 *      last_name:
 *        type: string
 *        description: Person's family name.
 */
const personSchema = new mongoose.Schema({
  name: {
    type: String,
    default: 'Person',
  },
  first_name: String,
  last_name: String,
  meta: {
    date_created: String,
    date_modified: String,
  }
});

export default mongoose.model('Person', personSchema);
