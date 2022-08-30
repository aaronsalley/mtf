import gearIcon from '../../public/images/mtf_gear_icon.svg';

export const initialState = {
  content: {
    message: 'Makers cohort 3 opens tomorrow!',
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
        { url: '/events', link: 'Events' },
        { url: '/programming', link: 'Programming' },
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
