'use strict';

import axios from 'axios';
import React, {Component} from 'react';

interface Props {
  maxItems: any;
}

class GramFeed extends Component<Props, {feed: any[]}> {
  private instagram = axios.create({
    baseURL: `https://graph.facebook.com/v3.1/${process.env.INSTAGRAM_BUSINESS_ACCOUNT_ID}`,
    headers: {
      'Authorization': `Bearer ${process.env.GRAPH_ACCESS_TOKEN}`,
      'Cache-Control': 'private, max-age=600',
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
      let cache: string | null = sessionStorage.getItem('mtfInstagram');
      let feed: { data: any; } = { data: {} };

      if ( !cache ) {
        console.log('in !feed');
        feed = await this.instagram.get('/media', {
          params: {
            fields: 'media_url',
            limit: this.props.maxItems,
          },
        });
        cache = JSON.stringify(feed);
        sessionStorage.setItem('mtfInstagram', cache);
      }

      feed = JSON.parse(cache);

      this.setState((props) => {
        return {
          feed: feed.data.data,
        };
      });
    } catch (err) {
      console.log(err);
    }
  }

  public listFeed = () => {
    const list: any[] = [];

    try {
      for (let i: number = 0; i < this.props.maxItems; i++) {
        const post: { media_url: string; } = this.state.feed[i];

        list.push(
          <div className='post'
          key={i.toString()}>
            <img src={post.media_url} className='image' />
          </div>,
        );
      }
    } catch (err) {
      console.log(err.message);
    }

    return list;
  }

  /**
   * Render the UI
   * @return {void} UI Elements
   */
  public render() {
    return(
      <div className='wrap'>
        {this.listFeed()}
      </div>
    );
  }
}

// GramFeed.defaultProps = {
//   maxItems: 50,
// };

export default GramFeed;
