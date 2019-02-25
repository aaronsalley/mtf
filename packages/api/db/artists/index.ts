'use strict';

import logger from 'logger';
import mongoose from 'mongoose';

/**
 * @swagger
 *
 * components:
 *  schemas:
 *   Artist:
 *    type: object
 *    required:
 *    - username
 *    properties:
 *      name:
 *        type: string
 *      username:
 *        type: string
 *      first_name:
 *        type: string
 *      middle_name:
 *        type: string
 *      last_name:
 *        type: string
 *      ssn:
 *        type: string
 *      birth_date:
 *        type: string
 *        format: date
 *      photos:
 *        type: array
 *        items:
 *          $ref: '#/components/schemas/document'
 *      email_addresses:
 *        type: object
 *        properties:
 *          address:
 *            type: string
 *          labels:
 *            type: string
 */
const artistSchema = new mongoose.Schema({
  name: {
    type: String,
    default: 'Artist',
  },
  first_name: String,
  last_name: String,
  meta: {
    date_created: String,
    date_modified: String,
  }
});

export default mongoose.model('Artist', artistSchema);
