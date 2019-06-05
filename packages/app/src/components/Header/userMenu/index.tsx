import React, { Component } from 'react';
import styles from './userMenu.module.scss';

import Apps from './widgets/apps';
import Notifications from './widgets/notifications';
import User from './widgets/user';

class UserMenu extends Component {
  render() {
    return (
      <div className={styles.user_menu}>
        <Apps />
        <Notifications />
        <User />
      </div>
    );
  }
}

export default UserMenu;
