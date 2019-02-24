'use strict';

import express from 'express';

import artistsRouter from './artists/index';

import authCheck from '../services/authService';

const router = express.Router();

router.use('/artists', artistsRouter);

/**
 * @swagger
 *
 * /dashboard:
 *  get:
 *    operationId:
 *    responses:
 *      200:
 *        description: OK
 */
router.route('/dashboard')
  .get(authCheck, (req, res) => {
    res.send('you are logged in, this is your profile');
  });

export default router;
