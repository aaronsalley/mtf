'use strict';

import {combineReducers} from 'redux';

// State Definitions
const UserStates = {
  LOGGED_IN: 'LOGGED_IN',
  LOGGED_OUT: 'LOGGED_OUT',
};

// Reducers
const userState = (state = UserStates.LOGGED_OUT, action) => {
  switch (action.type) {
    case 'SET_USER_STATE':
      return action.state;
    default:
      return state;
  }
};

const reducers = combineReducers({
  userState,
});

export {
  // Reducers
  reducers,
};
