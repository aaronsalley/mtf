import React, { Component } from 'react';
import $ from 'jquery';
import 'foundation-sites';
import styles from '../userMenu.module.scss';

class Widget extends Component {
  componentDidMount() {
    const options = {
      postition: 'bottom',
      alignment: 'center',
      closeOnClick: true,
    }
    const dropdown = new Foundation.Dropdown($('#notifications'), options);
  }

  render() {
    return (
      <div className={styles.notifications}>
        <button className={styles.button} data-toggle="notifications">
          <i className={styles.icon}>notifications</i>
        </button>
        <div className={styles.dropdown_pane} id="notifications">
        </div>
      </div>
    );
  }
}

export default Widget;
