import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import styles from './Content.module.scss';

import Toolbar from './Toolbar';
import People from './views/People';
import Projects from './views/Projects';
import Productions from './views/Productions';
import Reports from './views/Reports';

const Content = () => {
  return (
    <div className={styles.content}>
      <Toolbar />
      <Switch>
        <Route path='/people' component={People} />
        <Route path='/projects' component={Projects} />
        <Route path='/productions' component={Productions} />
        <Route path='/reports' component={Reports} />
      </Switch>
    </div>
  );
}

export default Content;
