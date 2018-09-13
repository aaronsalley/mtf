'use strict';

import React from 'React';
import {render} from 'react-dom';
import {Provider} from 'react-redux';
import {
  BrowserRouter,
} from 'react-router-dom';
import {configureStore} from './assets/js/store';
import App from './views/app';

// const store = configureStore();

const renderApp = () => render(
  // <Provider store={store}>
    <BrowserRouter>
      <App />
    </BrowserRouter>
  // </Provider>
  , document.getElementById('app')
);

if (process.env.NODE_ENV !== 'production' && module.hot) {
  module.hot.accept('./views', () => {
    renderApp();
  });
}

renderApp();
