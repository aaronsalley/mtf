import React, { Component } from 'react';
import styles from './Content.module.scss';

import Toolbar from './Toolbar';
import List from './views/User/list';

const Content = () => {
  return (
    <div className={styles.content}>
      <Toolbar />
      <List />
    </div>
  );
}

export default Content;
