'use strict';

import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
  Redirect,
  render,
  Route,
 } from 'react-router-dom';

const mapStateToProps = (state, ownProps) => {
  return {
  };
};

const createPrivateRoute = ({ component: Component, ...ownProps }) => {
  const whereTo = (props) => (
    sessionStorage.getItem('user') ?
    <Component {...props} />
    : <Redirect to='/login' />
  );
  return(
      <Route
        {...ownProps}
        render={whereTo}
      />
    );
};

export const PrivateRoute = connect(
  mapStateToProps,
)(createPrivateRoute);
