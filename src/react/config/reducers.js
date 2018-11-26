'use strict';

import {combineReducers} from 'redux';

// State Definitions
export const SET_USER_STATE = 'SET_USER_STATE';
export const UserStates = {
  LOGGED_IN: 'LOGGED_IN',
  LOGGED_OUT: 'LOGGED_OUT',
  AUTH_ERROR: 'AUTH_ERROR',
};
export function setUserState(state) {
  return {
    type: SET_USER_STATE,
    state: state,
  };
};

// Reducers
const initialUserState = {
  userState: UserStates.LOGGED_OUT,
};
function user( state = initialUserState, action ) {
  switch (action.type) {
    case SET_USER_STATE:
      return {...state, userState: action.state};
    default:
      return state;
  };
};

const reducers = combineReducers({
  user,
});

export default reducers;
