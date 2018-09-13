'use strict';

import axios from 'axios';
import React, {Component} from 'react';

interface Props {
  maxItems: any;
}

class GramFeed extends Component<Props, {feed: any[]}> {
  private instagram = axios.create({
    baseURL: 'https://api.instagram.com/v1',
    headers: {
      Authorization: `Bearer ${process.env.INSTAGRAM_CLIENT_SECRET}`,
    },
  });

  /**
   * Constructs the Form input props.
   * @param {string} props
   */
  constructor(props) {
    super(props);

    this.state = {
      feed: [],
    };
  }

  public async componentDidMount() {
    try {
      // const feed = await this.instagram.get('/users/');
      // this.setState((props) => {
      //   return {
      //     feed: feed.data,
      //   };
      // });
    } catch (err) {
      console.log(err);
    }
  }

  public listFeed = () => {
    const list: any[] = [];

    for (let i: number = 0; i < this.props.maxItems; i++) {
      list.push(
        <div className='post'
        key={i.toString()}></div>,
      );
    }

    return list;
  }

  /**
   * Render the UI
   * @return {void} UI Elements
   */
  public render() {
    return(
      <div className='instagram feed'>
        {this.listFeed()}
      </div>
    );
  }
}

export default GramFeed;
