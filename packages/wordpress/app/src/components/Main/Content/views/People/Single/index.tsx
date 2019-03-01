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
      editable: true,
      data: {},
    };
  }

  async componentDidMount() {
    let json: any = {};
    try {
      json = {
        'id': '1234567890',
        'name': 'people',
        'email': `someone@domain.com`,
        'display_name': 'First Last',
        'headshot':'https://randomuser.me/api/portraits/men/7.jpg',
        'reel': 'reel',
      };
    } catch(error) {
      if (process.env.NODE_ENV !== 'production')
        console.log(error);
    }

    this.setState({
      data: json,
    })
  }

  Profile = () => {
    if ( this.state.editable ){
      return (
        <this.EditProfile />
      )
    }

    return (
      <this.ReadProfile />
    )
  }

  EditProfile = () => {
    return (
      <article>
        <header>
          <div>
            <img src="#" />
          </div>
          <div>
            <input></input>
            <input></input>
          </div>
        </header>
        <section></section>
        <section></section>
        <section></section>
        <section></section>
        <footer></footer>
      </article>
    )
  }

  ReadProfile = () => {
    // const {
    //   name,
    //   id,
    //   headshot,
    //   display_name,
    //   email,
    //   reel,
    // } = this.state.data;
    //
    // if( id == undefined ) {
    //   return (
    //     <div>
    //       Whoops, something's gone wrong.
    //     </div>
    //   )
    // }
    return (
      <article>
        <header>
          <div>
            <img src="#" />
          </div>
          <div>
            <h2></h2>
            <p></p>
          </div>
        </header>
        <section></section>
        <section></section>
        <section></section>
        <section></section>
        <footer></footer>
      </article>
    )
  }

  render() {
    return (
      <this.Profile />
    );
  }
}

export default connect(
  mapStateToProps,
)(List);
