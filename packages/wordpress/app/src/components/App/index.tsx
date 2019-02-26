import React from 'react';
import './App.css';

import Footer from '../Footer';
import Header from '../Header';
import Main from '../Main';
import NavDrawer from '../NavDrawer';

const App = () => {
  return (
    <div className="App">
      <Header />
      <NavDrawer />
      <Main />
      <Footer />
    </div>
  )
}

export default App;
