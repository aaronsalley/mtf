import React from 'react';
import {
  Route as PublicRoute,
  Switch,
} from 'react-router-dom';

import '../assets/scss/style.scss';
import Header from './containers/header';
import Main from './containers/main';
import Footer from './containers/footer';

const App = () => {
  return (
    <div>
      <Header />
      <Main />
      <Footer />
    </div>
  );
};

export default App;
