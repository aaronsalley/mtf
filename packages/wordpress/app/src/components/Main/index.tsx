import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import styles from './Main.module.scss';

import Content from './Content';
import Sidebar from './Sidebar';
import Toolbar from './Toolbar';

const Main = () => {
  return (
    <div className={styles.main}>
      <Sidebar />
      <Switch>
        <Route path='/' component={Content} />
      </Switch>
      <Toolbar />
    </div>
  );
}

export default Main;
