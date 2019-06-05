import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Link } from 'react-router-dom';
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
            <Link className={styles.app} to="/people">
              <i className={styles.icon}>people</i>
              <p className={styles.label}>People</p>
            </Link>
            <Link className={styles.app} to="/projects">
              <i className={styles.icon}>work</i>
              <p className={styles.label}>Projects</p>
            </Link>
            <Link className={styles.app} to="/productions">
              <i className={styles.icon}>local_play</i>
              <p className={styles.label}>Productions</p>
            </Link>
            <Link className={styles.app} to="/reports">
              <i className={styles.icon}>poll</i>
              <p className={styles.label}>Reports</p>
            </Link>
        </div>
      </div>
    );
  }
}

export default Widget;
