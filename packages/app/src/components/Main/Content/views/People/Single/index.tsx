import React, { Component } from 'react';
import { connect } from 'react-redux';
import { BrowserRouter as Router, Route, Link } from 'react-router-dom';
import styles from './single.module.scss';

const mapStateToProps = (state: any, ownProps: any) => {
  return {
    editable: state.editable,
  }
}

class List extends Component<any, any> {
  constructor(props: any) {
    super(props);
    this.state = {
      editable: false,
      data: {},
    };
  }

  async componentDidMount() {
    let json: any = {};
    try {
      json = {
        'id': '1234567890',
        'name': 'people',
        'display_name': 'First Last',
        'first_name': 'First',
        'last_name': 'Last',
        'headshot':'https://randomuser.me/api/portraits/men/7.jpg',
        'email': 'someone@domain.com',
        'phone': '1234567890',
        'reel': 'reel',
        'resume':[],
        'street_1':'',
        'street_2':'',
        'city':'',
        'state':'',
        'zip':'',
        'attachments':[],
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
    if ( this.props.editable ){
      return (
        <this.EditProfile />
      )
    }

    return (
      <this.ReadProfile />
    )
  }

  EditProfile = () => {
    const {
      headshot,
      first_name,
      last_name,
      email,
      phone,
      reel,
      resume,
      skills,
      street_1,
      city,
      state,
      zip,
    } = this.state.data;
    return (
      <article>
        <header>
          <div className={styles.headshot}>
            <img src={headshot} />
          </div>
          <div className={styles.name}>
            <input className={styles.first_name}
                   defaultValue={first_name}>
            </input>
            <input className={styles.last_name}
                   defaultValue={last_name}>
            </input>
          </div>
          <div className={styles.contact}>
            <a href={'mailto:' + email}
              className={styles.email}>email</a>
            <a href={phone} className={styles.phone}>phone</a>
            <a href={reel} className={styles.reel}>video</a>
          </div>
        </header>
        <section className={styles.resume}>
          {resume}
        </section>
        <section className={styles.skills}>
          {skills}
        </section>
        <section className={styles.details}>
          <div className={styles.address}>
            <input className={styles.street}
                   defaultValue={street_1}>
            </input>
            <input className={styles.city}
                   defaultValue={city}>
            </input>
            <input className={styles.state}
                   defaultValue={state}>
            </input>
            <input className={styles.zip}
                   defaultValue={zip}>
            </input>
          </div>
          <div className={styles.attachments}>
            <input className={styles.w9}></input>
            <input className={styles.nda}></input>
            <input className={styles.agreement}></input>
            <input className={styles.agreement}></input>
          </div>
        </section>
        <footer className={styles.meta}>
          <p>created</p>
        </footer>
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
          <div className={styles.headshot}>
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
