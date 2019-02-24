'use strict';

import express from 'express';
import logger from 'logger';

import authCheck from '../../services/authService';
import Artists from '../../controllers/artists';

const router = express.Router();

/**
 * @swagger
 *
 * /artists:
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
  .post(Artists.createArtist)
  .get(Artists.createArtist);

/**
 * @swagger
 *
 * /artists/{artistID}:
 *  get:
 *    operationId:
 *    responses:
 *      200:
 *        description: OK
 *  patch:
 *    operationId:
 *    responses:
 *      201:
 *        description: OK
 *  delete:
 *    operationId:
 *    responses:
 *      201:
 *        description: OK
 */
router.route('/:artistID')
  .get(Artists.readArtist)
  .patch(Artists.updateArtist)
  .delete(Artists.deleteArtist);

export default router;
