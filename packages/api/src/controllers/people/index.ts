'use strict';

import logger from 'logger';

import peopleServices from '../../services/people';

class People {
  createPerson = async (req, res, next) => {
    try {
      peopleServices.Services()
      res.status(201).send('Created person.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create person.')
    }
  }

  getPerson = async (req, res, next) => {
    try {
      res.status(201).send('Created person.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create person.')
    }
  }

  updatePerson = async (req, res, next) => {
    try {
      res.status(201).send('Created person.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create person.')
    }
  }

  deletePerson = async (req, res, next) => {
    try {
      res.status(201).send('Created person.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create person.')
    }
  }
}

export default new People();
