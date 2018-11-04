import React from 'react';
import {
  Route as PublicRoute,
  Switch,
} from 'react-router-dom';

import '../assets/scss/style.scss';

import Footer from './components/footer';
import Header from './components/header';
import Main from './containers/main';

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
