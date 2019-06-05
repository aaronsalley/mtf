import {createStore, applyMiddleware} from 'redux';
import reduxThunk from 'redux-thunk';

import reducers from './reducers';

const _createStore = applyMiddleware(reduxThunk)(createStore);
const store = _createStore(reducers);

export default store;
