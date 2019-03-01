import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

import List from './List';
import Single from './Single';

const Content = () => {
  return (
    <Switch>
      <Route exact path='/projects' component={List} />
      <Route path='/projects/:id' component={Single} />
    </Switch>
  );
}

export default Content;
