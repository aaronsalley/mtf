import React, { Component } from 'react';
import { connect } from 'react-redux';
import $ from 'jquery';
import 'foundation-sites';
import styles from '../userMenu.module.scss';

const mapStateToProps = (state:any, ownProps:any) => {
  return {
    companyLogo: state.companyLogo,
    userImage: state.userImage,
  }
}

class Widget extends Component<any> {
  constructor(props:any) {
    super(props);
    this.state = {
    };
  }

  componentDidMount() {
    const options = {
      postition: 'bottom',
      alignment: 'center',
      closeOnClick: true,
    }
    const dropdown = new Foundation.Dropdown($('#user'), options);
  }

  render() {
    return (
      <div className={styles.user}>
        <button className={styles.button} data-toggle="user">
          <span className={styles.logo}>
            <img src={this.props.companyLogo} />
          </span>
          <span className={styles.user_image}>
            <img src={this.props.userImage} />
          </span>
        </button>
        <div className={styles.dropdown_pane} id="user">
        </div>
      </div>
    );
  }
}

export default connect(
  mapStateToProps,
)(Widget);
