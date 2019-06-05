import { doSomething } from '../actions';

const initialState = {
  companyLogo: 'https://mtf.nyc/wp-content/uploads/2019/02/MTF-Logo-compact-black.png',
  userImage: 'https://randomuser.me/api/portraits/men/77.jpg',
  editable: true,
}

function app(state = initialState, action: any) {
  return state
}

export default app;
