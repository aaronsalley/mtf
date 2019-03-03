'use strict';

import express from 'express';

import peopleRouter from './people/index';

import authCheck from '../services/authService';

const router = express.Router();

router.use('/people', peopleRouter);

export default router;
