'use strict';

import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter, Route as PublicRoute, Switch } from 'react-router-dom';
import { applyMiddleware, createStore } from 'redux';
import reduxThunk from 'redux-thunk';
import { PrivateRoute } from './react/routes/middlewears/PrivateRoute';

import reducers from './react/config/reducers';
import Person from './react/views/Person';

const _createStore = applyMiddleware(reduxThunk)(createStore);
const store = _createStore(reducers);

const renderApp = ({store}) => render(
    <Provider store={store}>
      <BrowserRouter>
        <Switch>
          <PublicRoute path="/login" component={Person} />
          <PublicRoute path="/register" component={Person} />
          <PrivateRoute path="/admin" component={Person} />
          <PublicRoute path="/" component={Person} />
        </Switch>
      </BrowserRouter>
    </Provider>
    , document.getElementById('app'),
);

// if (process.env.NODE_ENV !== 'production' && module.hot) {
//   module.hot.accept('./react/app', () => {
//     renderApp({store});
//   });
// }

renderApp({store});
