'use strict';

import express from 'express';

import Users from './controllers/usersController';

const router = express.Router();

router.route('/users')
  .post(Users.createUser)
  .get(Users.listUsers);

export default router;
