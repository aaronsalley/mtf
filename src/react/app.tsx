'use strict';

import React from 'react';
import {
  Route as PublicRoute,
  Switch,
} from 'react-router-dom';

import Person from './views/Person';

const App = () => {
  return (
    <div>
      Hello react.
      <Person />
    </div>
  );
};

export default App;
