'use strict';

import logger from 'logger';

class Artists {
  createArtist = async (req, res, next) => {
    try {
      res.status(201).send('Created artist.')
    } catch(error) {
      logger.error(error);
      res.status(500).send('Cannot create artist.')
    }
  }

  readArtist = async (req, res, next) => {
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
