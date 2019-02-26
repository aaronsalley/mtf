import React from 'react';
import styles from './App.module.scss';

import Header from '../Header';
import Main from '../Main';
import Footer from '../Footer';

const App = () => {
  return (
    <div className={styles.superView}>
      <Header />
      <Main />
    </div>
  )
}

export default App;
