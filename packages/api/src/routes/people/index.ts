'use strict';

import express from 'express';
import logger from 'logger';

import authCheck from '../../services/authService';
import People from '../../controllers/people';

const router = express.Router();

/**
 * @swagger
 *
 * /people:
 *  post:
 *    operationId:
 *    responses:
 *      201:
 *        description: OK
 *  get:
 *    operationId:
 *    responses:
 *      200:
 *        description: OK
 */
router.route('/')
  .post(People.createPerson)
  .get(People.createPerson);

/**
 * @swagger
 *
 * /people/{artistID}:
 *  get:
 *    operationId:
 *    responses:
 *      200:
 *        description: OK
 *        content:
 *          application/json:
 *            schema:
 *              $ref: '#/components/schemas/Person'
 *  patch:
 *    operationId:
 *    responses:
 *      201:
 *        description: OK
 *        content:
 *          application/json:
 *            schema:
 *              $ref: '#/components/schemas/Person'
 *  delete:
 *    operationId:
 *    responses:
 *      201:
 *        description: OK
 */
router.route('/:artistID')
  .get(People.getPerson)
  .patch(People.updatePerson)
  .delete(People.deletePerson);

export default router;
