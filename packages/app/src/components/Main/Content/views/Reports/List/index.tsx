import React, { Component } from 'react';
import { connect } from 'react-redux';
import { BrowserRouter as Router, Route, Link } from 'react-router-dom';
import styles from './list.module.scss';

const mapStateToProps = (state: object, ownProps: any) => {
  return {
  }
}

class List extends Component<any, any> {
  constructor(props: any) {
    super(props);
    this.state = {
      data: [],
    };
  }

  async componentDidMount() {
    let json = [];
    try {
      const count = 100;
      for ( let i = 0; i < count; i ++ ) {
        json.push(
          {
            'id': '1234567890',
            'name': 'people',
            'title':'title'
          },
        );
      }
    } catch(error) {
      if (process.env.NODE_ENV !== 'production')
        console.log(error);
    }

    this.setState({
      data: json,
    })
  }

  /**
   * Returns individual list item data
   * @param data: any JSON data
   * @return listItem Styled list entry
   */
  ListItem = (data: any) => {
    const {
      name,
      id,
      title,
    } = data.value;

    return (
      <div className={styles.item}>
        <h6>{title}</h6>
      </div>
    )
  }

  // Return a list of all the data pulled
  List = () => {
    const list = this.state.data.map((data: object, index: number) =>
      <this.ListItem key={index}
                value={data} />
    );

    return (
      <div className={styles.list}>
        {list}
      </div>
    );
  }

  render() {
    return (
      <this.List />
    );
  }
}

export default connect(
  mapStateToProps,
)(List);
