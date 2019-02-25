import { doSomething } from '../actions';

const initialState = {
  something: doSomething,
}

function app(state = initialState, action: any) {
  return state
}

export default app;
