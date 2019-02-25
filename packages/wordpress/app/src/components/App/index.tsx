import React from 'react';
import './App.css';

import Footer from '../Footer';
import Header from '../Header';
import Main from '../Main';
import Sidebar from '../Sidebar';

const App = () => {
  return (
    <div className="App">
      <Header />
      <Sidebar />
      <Main />
      <Footer />
    </div>
  )
}

export default App;
