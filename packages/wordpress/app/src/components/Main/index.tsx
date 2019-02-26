import React, { Component } from 'react';
import styles from './Main.module.scss';

import Content from './Content';
import Sidebar from './Sidebar';

const Main = () => {
  return (
    <div className={styles.main}>
      <Sidebar />
      <Content />
    </div>
  );
}

export default Main;
