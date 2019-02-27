import React, { Component } from 'react';
import styles from './search.module.scss';

class Search extends Component {
  render() {
    return (
      <div className={styles.search_bar}>
        <span className={styles.label}>search</span>
        <input type="search" className={styles.input} placeholder="Search MTF" />
        <div className={styles.button_group}>
          <input type="submit" value="arrow_drop_down" className={styles.button} />
        </div>
      </div>
    );
  }
}

export default Search;
