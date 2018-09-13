'use strict';

import React, {Component} from 'react';

const Footer = () => {
  return(
    <footer className='footer'>
      <menu>
        {/* Get from WP */}
          <ul id=''>
          </ul>
          <ul id=''>
          </ul>
          <ul id=''>
          </ul>
          <ul id=''>
          </ul>
      </menu>
      <form id='mailing-list'>
        <div className='input-group'>
          <label className='input-group-label'
            htmlFor='email'>
            Join our mailing list
          </label>
          <input className='input-group-field'
            type='email'
            placeholder='Join our mailing list' />
          <button className='input-group-button button primary'
            type='submit'>Sign up</button>
        </div>
        <a className=''
          href=''>How do we use this information?</a>
      </form>
      <address className='copyright'>
        © 2018 Copyright Musical Theatre Factory, 440 Lafayete St., 4th Floor, New York, NY 10003.
      </address>
    </footer>
  )
}

export default Footer;
