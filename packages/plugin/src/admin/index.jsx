import React from 'react';
import ReactDOM from 'react-dom';
import {
  Router,
  useLocation
} from 'react-router-dom';
import { createBrowserHistory } from "history";
import Events from './components/Events';
import People from './components/People';
import Projects from './components/Projects';
import Reports from './components/Reports';

const history = createBrowserHistory();

const App = () => {
  const useQuery = () => {
    return new URLSearchParams(useLocation().search);
  }
  const query = useQuery().get('page');

  let component;
  switch (query) {
    case 'mission_cmd_events':
      component = <Events />;
      break;
    case 'mission_cmd_people':
      component = <People />;
      break;
    case 'mission_cmd_projects':
      component = <Projects />;
      break;
    case 'mission_cmd_reports':
      component = <Reports />;
      break;
    default:
      break;
  }

  return (
    component
  )
}

if (document.getElementById('mission-command')) {
  ReactDOM.render(
    <Router history={history}>
      <App />
    </Router>,
    document.getElementById('mission-command')
  );
}