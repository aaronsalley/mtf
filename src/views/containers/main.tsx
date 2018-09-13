'use strict';

import React, {Component} from 'react';
import Events from '../components/events';
import GramFeed from '../components/gramfeed';

const Main = () => {
  return(
    <main>A
      <Events maxItems='4' />
      <GramFeed maxItems='100' />
    </main>
  )
}

export default Main;
