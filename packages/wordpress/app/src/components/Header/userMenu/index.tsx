import React, { Component } from 'react';
import styles from './userMenu.module.scss';

class UserMenu extends Component {
  render() {
    return (
      <div className={styles.userMenu}>
        <button className={styles.button}>
          <i className="material-icons md-24">apps</i>
        </button>
        <button className={styles.button}>
          <i className="material-icons md-24">notifications</i>
        </button>
        <button className={styles.button}>
          <img className="logo" src="#" />
          <span className="userImage">
            <img src="#" />
          </span>
        </button>
      </div>
    );
  }
}

export default UserMenu;
