'use strict';

import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';

import Home from '../views/home';

const Main = () => {
  return(
    <Switch>
      <Route path="/" component={Home} />
    </Switch>
  );
};

export default Main;
