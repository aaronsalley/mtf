import React, { Component } from 'react';
import $ from 'jquery';
import 'foundation-sites';
import styles from '../userMenu.module.scss';

class Widget extends Component {
  async componentDidMount() {
    const options = {
      postition: 'bottom',
      alignment: 'center',
      closeOnClick: true,
    }
    const dropdown = new Foundation.Dropdown($('#apps'), options);
  }
  render() {
    return (
      <div className={styles.apps}>
        <button className={styles.button} data-toggle="apps">
          <i className={styles.icon}>apps</i>
        </button>
        <div className={styles.dropdown_pane} id="apps">
            <a className={styles.app} href="#">
              <i className={styles.icon}>people</i>
              <p className={styles.label}>People</p>
            </a>
            <a className={styles.app} href="#">
              <i className={styles.icon}>work</i>
              <p className={styles.label}>Projects</p>
            </a>
            <a className={styles.app} href="#">
              <i className={styles.icon}>local_play</i>
              <p className={styles.label}>Productions</p>
            </a>
            <a className={styles.app} href="#">
              <i className={styles.icon}>poll</i>
              <p className={styles.label}>Reports</p>
            </a>
        </div>
      </div>
    );
  }
}

export default Widget;
