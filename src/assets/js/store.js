'use strict';

import {composeWithDevTools} from 'redux-devtools-extension';
import {applyMiddlewear, createStore} from 'redux';
import {reducers} from './reducers';

const configureStore = (preloadedState) => {
  // let middlewear = [logger];
  // middlewear = applyMiddlewear(...middlewear);
  //
  let enhancers = [];
  enhancers = composeWithDevTools(...enhancers);

  const store = createStore(reducers, preloadedState, enhancers);

  if (process.env.NODE_ENV !== 'production' && module.hot) {
    module.hot.accept('./reducers', () => {
      store.replaceReducer(reducers);
    });
  }

  return store;
};

export default {configureStore};
