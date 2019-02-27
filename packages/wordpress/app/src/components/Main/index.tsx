import React, { Component } from 'react';
import styles from './Main.module.scss';

import Content from './Content';
import Sidebar from './Sidebar';
import Toolbar from './Toolbar';

const Main = () => {
  return (
    <div className={styles.main}>
      <Sidebar />
      <Content />
      <Toolbar />
    </div>
  );
}

export default Main;
