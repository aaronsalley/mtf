import React, { Component } from 'react';
import styles from './Header.module.scss';

import Search from './search';
import UserMenu from './userMenu';

const Header = () => {
  return (
    <header className={styles.header}>
      <div className={styles.branding}>
        <i className={styles.icon}>menu</i>
        <span className={styles.logo}></span>
      </div>
      <Search />
      <UserMenu />
    </header>
  );
}

export default Header;
