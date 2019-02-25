'use strict';

import logger from 'logger';

import artistServices from '../../services/artists';

class Artists {
  createArtist = async (req, res, next) => {
    try {
      artistServices.Services()
      res.status(201).send('Created artist.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create artist.')
    }
  }

  getArtist = async (req, res, next) => {
    try {
      res.status(201).send('Created artist.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create artist.')
    }
  }

  updateArtist = async (req, res, next) => {
    try {
      res.status(201).send('Created artist.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create artist.')
    }
  }

  deleteArtist = async (req, res, next) => {
    try {
      res.status(201).send('Created artist.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create artist.')
    }
  }
}

export default new Artists();
