'use strict';

import React from 'React';
import {render} from 'react-dom';
import {Provider} from 'react-redux';
import {
  BrowserRouter,
} from 'react-router-dom';

import App from './react/app';

// import {configureStore} from './assets/js/store';
// const store = configureStore();

const renderApp = () => render(
    // <Provider store={store}>
    <BrowserRouter>
      <App />
    </BrowserRouter>
    // </Provider>
    , document.getElementById('app'),
);

// if (process.env.NODE_ENV !== 'production' && module.hot) {
//   module.hot.accept('./views', () => {
//     renderApp();
//   });
// }

renderApp();
