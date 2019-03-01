import React, { Component } from 'react';
import { connect } from 'react-redux';
import { BrowserRouter as Router, Route, Link } from 'react-router-dom';
import styles from './single.module.scss';

const mapStateToProps = (state: object, ownProps: any) => {
  return {
  }
}

class List extends Component<any, any> {
  constructor(props: any) {
    super(props);
    this.state = {
      data: {},
    };
  }

  async componentDidMount() {
    let json: any = {};
    try {
      json = {
        'id': '1234567890',
        'name': 'reports',
      };
    } catch(error) {
      if (process.env.NODE_ENV !== 'production')
        console.log(error);
    }

    this.setState({
      data: json,
    })
  }

  render() {
    return (
      <div>
        Content
      </div>
    );
  }
}

export default connect(
  mapStateToProps,
)(List);
