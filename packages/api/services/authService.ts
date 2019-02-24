'use strict';

import logger from 'logger';
import passport from 'passport';

import GoogleStrategy from 'passport-google-oauth20';
import {Strategy as JwtStrategy, ExtractJwt} from 'passport-jwt';

const authCheck = [
  passport.authenticate('jwt', {session: false}), (req, res, next) => {
    next();
  }
];

// Put userID in a cookie
passport.serializeUser((user, done) => {
  // done(null, user.id);
});

/**
  * Retrieve the rest of the user's information
  * based on the serialized userID in the cookie
  */
passport.deserializeUser((id, done) => {
  // Credentials
  //   .findById(id)
  //     .then((user) => {
  //       done(null, user);
  //     });
});

/**
  * Authorize app using local username and password
  */
passport.use(
  new JwtStrategy({
    secretOrKey: process.env.JWT_SECRET,
    jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
    issuer: process.env.API_SERVER,
    // algorithms: 'HS512',
  }, async (jwtPayload, done) => {
    try {
      // let user = await Credentials.findOne({
      //   _id: jwtPayload._id,
      // }).catch((err) => {
      //   throw new Error(err.message);
      // });
      // if (user) {
      //   done(null, user);
      // } else {
      //   done(null, false);
      // }
    } catch (err) {
      done(err);
      logger.error(err);
    }
  })
);

/**
  * Authorize app using Google login
  */
passport.use(
  new GoogleStrategy({
    callbackURL: '/auth/google/redirect',
    clientID: process.env.GOOGLE_CLIENT_ID,
    clientSecret: process.env.GOOGLE_CLIENT_SECRET,
  }, async (accessToken, refreshToken, profile, done) => {
    try {
      // // check if user exists
      // let user = await Credentials.findOne({
      //   google_id: profile.id,
      // }).catch((err) => {
      //   throw new Error(err.message);
      // });
      // if (user) {
      //   done(null, user);
      // } else {
      //   // If not, sign them up
      //   Passport.registerGoogle(profile).catch((err) => {
      //     throw new Error(err.message);
      //   });
      //   done(null, user);
      // }
    } catch (err) {
      done(err);
      logger.error(err);
    }
  })
);

export default authCheck;
