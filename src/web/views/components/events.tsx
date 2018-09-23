'use strict';

import axios from 'axios';
import React, {Component} from 'react';

interface Props {
  maxItems: any;
}

class Events extends Component<Props, {events: any[]}> {
  public eventbrite = axios.create({
    baseURL: 'https://www.eventbriteapi.com/v3/organizers/15023933479',
    headers: {
      Authorization: `Bearer ${process.env.EVENTBRITE_PUBLIC_TOKEN}`,
    },
  });

  /**
   * Constructs the Form input props.
   * @param {string} props
   */
  constructor(props) {
    super(props);

    this.state = {
      events: [],
    };
  }

  public async componentDidMount() {
    try {
      const events = await this.eventbrite.get('/events/', {
        params: {
          order_by: 'start_desc',
        },
      });
      this.setState((props) => {
        return {
          events: events.data.events,
        };
      });
    } catch (err) {
      if (process.env.NODE_ENV !== 'production') {
        console.log(err);
      }
    }
  }

  public eventsList = () => {
    const list: any[] = [];

    try {
      for (let i: number = 0; i < this.props.maxItems; i++) {
        const event = this.state.events[i];
        const date = new Date(event.start.local);

        list.push(
          <article className={`event ${event.status}`}
            key={i.toString()} >
            <div className='image'>
              <img src=''/>
            </div>
            <h2 className='title'>{event.name.text}</h2>
            <p className='date'>{date.toLocaleDateString('en-US')}</p>
            <p className='location'>{event.venue_id}</p>
          </article>,
        );
      }
    } catch (err) {
      if (process.env.NODE_ENV !== 'production') {
        console.log(err);
      }
    }

    return list;
  }

  public render() {
    return(
      <section className='events list'>
        {this.eventsList()}
      </section>
    );
  }
}

export default Events;
