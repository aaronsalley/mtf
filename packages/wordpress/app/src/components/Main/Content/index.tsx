import React, { Component } from 'react';
import styles from './Content.module.scss';

import Toolbar from './Toolbar';

const Content = () => {
  return (
    <div className={styles.content}>
      <Toolbar />
    </div>
  );
}

export default Content;
