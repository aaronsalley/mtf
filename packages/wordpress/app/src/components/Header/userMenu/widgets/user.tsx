import React, { Component } from 'react';
import styles from '../userMenu.module.scss';

class Widget extends Component {
  getCompanyLogo = () => {
    return 'https://mtf.nyc/wp-content/uploads/2019/02/MTF-Logo-compact-black.png';
  }

  getUserImage = () => {
    return 'https://randomuser.me/api/portraits/men/77.jpg';
  }

  render() {
    const companyLogo = this.getCompanyLogo();
    const userImage = this.getUserImage();

    return (
      <div className={styles.user}>
        <button className={styles.button} data-toggle="user">
          <span className={styles.logo}>
            <img src={companyLogo} />
          </span>
          <span className={styles.user_image}>
            <img src={userImage} />
          </span>
        </button>
        <div className={styles.dropdown_pane} id="user">
        </div>
      </div>
    );
  }
}

export default Widget;
