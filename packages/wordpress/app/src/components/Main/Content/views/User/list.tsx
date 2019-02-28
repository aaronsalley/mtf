import React, { Component } from 'react';
import { connect } from 'react-redux';
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
            'email': `someone@domain.com`,
            'name': 'First Last',
            'headshot':'https://randomuser.me/api/portraits/men/7.jpg',
            'reel': 'reel',
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
      headshot,
      name,
      email,
      reel,
    } = data.value;

    return (
      <div className={styles.item}>
        <a href="#">
          <div>
            <img src={headshot as string} />
          </div>
          <h5 className={styles.name}>{name as string}</h5>
        </a>
        <div className={styles.actions}>
          <a href={'mailto:' + email as string} className={styles.action}>email</a>
          <a href={reel as string} className={styles.action}>video_library</a>
        </div>
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
