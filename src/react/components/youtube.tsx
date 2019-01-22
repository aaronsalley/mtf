'use strict';

import axios from 'axios';
// import Youtube from 'instafeed.js';
import React, {Component} from 'react';

interface Props {
  maxItems: any;
}

class YouTubeFeed extends Component<Props, {feed: any[]}> {
  // private youtube = new axios({
  //   baseURL: 'https://www.googleapis.com/youtube/v3',
  // });
  //
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
  //
  // public async componentDidMount() {
  //   try {
  //     let feed: { data: any; } = { data: {} };
  //
  //     feed = await this.youtube.get('/channels', {
  //       params: {
  //         forUsername: 'mtfnyc',
  //         limit: this.props.maxItems,
  //       },
  //     });
  //     cache = JSON.stringify(feed);
  //     sessionStorage.setItem('mtfInstagram', cache);
  //
  //     feed = JSON.parse(cache);
  //
  //     this.setState((props) => {
  //       return {
  //         feed: feed.data.data,
  //       };
  //     });
  //   } catch (err) {
  //     if (process.env.NODE_ENV !== 'production') {
  //       console.log(err);
  //     }
  //   }
  // }
  //
  // public listFeed = () => {
  //   const list: any[] = [];
  //
  //   try {
  //     for (let i: number = 0; i < this.props.maxItems; i++) {
  //       const post: { media_url: string; } = this.state.feed[i];
  //
  //       list.push(
  //         <div className='post'
  //         key={i.toString()}>
  //           <img src={post.media_url} className='image' />
  //         </div>,
  //       );
  //     }
  //   } catch (err) {
  //     if (process.env.NODE_ENV !== 'production') {
  //       console.log(err);
  //     }
  //   }
  //
  //   return list;
  // }

  /**
   * Render the UI
   * @return {void} UI Elements
   */
  public render() {
    return(
      <div className='wrap'>
      </div>
    );
  }
}

// YouTubeFeed.defaultProps = {
//   maxItems: 50,
// };

export default YouTubeFeed;
