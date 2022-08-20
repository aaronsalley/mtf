import gearIcon from '../../public/images/mtf_gear_icon.svg';

export const initialState = {
  content: {
    message: 'Makers cohort 3 opens tomorrow!',
    pages: [],
    events: [
      {
        thumbnail: '',
        title: 'Event Title 1',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
      {
        thumbnail: '',
        title: 'Event Title',
        startDate: '12.01.2021',
        endDate: '12.01.2021',
        summary: 'Event summary.',
        link: {
          text: 'Details',
          url: '#',
        },
      },
    ],
    posts: [
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
      {
        title: 'Article title 8',
        pubDate: '12.01.2021',
        summary: 'This is the article copy.',
        link: { text: 'Read more', url: '#' },
      },
    ],
  },
  settings: {
    siteTitle: 'Musical Theatre Factory',
    tagline: '',
    adminEmail: '',
  },
  theme: {
    logo: gearIcon,
    favicon: '',
    menus: {
      main: [
        { url: 'events', link: 'Events' },
        { url: 'programming', link: 'Programming' },
        { url: '', link: '' },
      ],
    },
  },
};

export const state = (state = initialState, action = { type: '' }) => {
  switch (action.type) {
    default:
      return state;
  }
};

export const store = state();
