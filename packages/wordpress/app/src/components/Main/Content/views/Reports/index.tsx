import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

import List from './List';
import Single from './Single';

const Content = () => {
  return (
    <Switch>
      <Route exact path='/reports' component={List} />
      <Route path='/reports/:id' component={Single} />
    </Switch>
  );
}

export default Content;
