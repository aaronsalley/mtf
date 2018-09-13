'use strict';

import React, {Component} from 'react';

const Header = () => {
  return(
    <header className='header'>
      <div>
        {/* Get from WP */}
        <img src='' />
        <h1>Musical Theatre Factory</h1>
      </div>
      <menu>
        <li id='facebook'>Facebook</li>
        <li id='twitter'>Twitter</li>
        <li id='youtube'>YouTube</li>
        <li id='instagram'>Instagram</li>
        <a id='donate' className='button'>Donate</a>
      </menu>
      <nav>
        {/* Get from WP */}
        <li>Events</li>
        <li>Community</li>
        <li>About</li>
        <li>Support Us</li>
      </nav>
    </header>
  )
}

export default Header;
