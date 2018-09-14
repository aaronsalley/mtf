'use strict';

import React, {Component} from 'react';
import {Switch, Route} from 'react-router-dom';

import Home from './home';

const Main = () => {
  return(
    <Switch>
      <Route path="/" component={Home} />
    </Switch>
  )
}

export default Main;
