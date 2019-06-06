'use strict';

import express from 'express';
import logger from 'logger';

import authCheck from '../../services/authService';
import Projects from '../../controllers/projects';

const router = express.Router();

/**
 * @swagger
 *
 * /projects:
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
  .post(Projects.createPerson)
  .get(Projects.createPerson);

/**
 * @swagger
 *
 * /projects/{projectID}:
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
router.route('/:projectID')
  .get(Projects.getPerson)
  .patch(Projects.updatePerson)
  .delete(Projects.deletePerson);

export default router;
