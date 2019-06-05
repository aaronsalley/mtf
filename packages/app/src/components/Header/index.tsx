import React, { Component } from 'react';
import styles from './Header.module.scss';

import Search from './search';
import UserMenu from './userMenu';

const Header = () => {
  return (
    <header className={styles.header}>
      <div className={styles.branding}>
        <button className={styles.button}>
          <i className={styles.icon}>menu</i>
        </button>
        <span className={styles.logo}></span>
      </div>
      <Search />
      <UserMenu />
    </header>
  );
}

export default Header;
