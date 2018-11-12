'use strict';

import axios from 'axios';
import React, {Component} from 'react';

interface Props {
  maxItems: any;
}

class LocalFeed extends Component<Props, {images: any[]}> {
  public wordpress = axios.create({
    baseURL: '//mtf.nyc/wp-json/wp/v2/',
  });
  /**
   * Constructs the Form input props.
   * @param {string} props
   */
  constructor(props) {
    super(props);

    this.state = {
      images: [],
    };
  }

  public async componentDidMount() {
    const images: { data: any; } = { data: {} };
    try {
      const post = await this.wordpress.get('/pages/82');

      this.setState((props) => {
        return {
          images: images.data.content.rendered,
        };
      });
    } catch (error) {
      if (process.env.NODE_ENV !== 'production') {
        console.log(error);
      }
    }
  }

  public getGallery = () => {
    const gallery: any[] = [];

    try {
      for (let i: number = 0; i < this.props.maxItems; i++) {
        const post: { media_url: string; } = this.state.images[i];

        gallery.push(
          <div className='post'
          key={i.toString()}>
            <img src={post.media_url} className='image' />
          </div>,
        );
      }
    } catch (error) {
      if (process.env.NODE_ENV !== 'production') {
        console.log(error);
      }
    }

    return gallery;
  }

  /**
   * Render the UI
   * @return {void} UI Elements
   */
  public render() {
    return(
      <div className='wrap'>
        {this.getGallery()}
      </div>
    );
  }
}

export default LocalFeed;
