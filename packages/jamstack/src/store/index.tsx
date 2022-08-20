import { createContext } from 'react';
import { store } from './state';

const Context = createContext({} as any);
Context.displayName = 'State';

export default Context;

export const connect = (state?: any, dispatch = {}) => {
  const stateProps: any = state ? state(store) : undefined;

  // TODO: only get the {...dispatch} items from the store
  const dispatchProps: any = [];

  const props = { ...stateProps, ...dispatchProps };

  const enhance = (Component: any) => {
    const ConnectedComponent = (ownProps?: any) => {
      return <Component {...props} ownProps={ownProps} />;
    };

    return ConnectedComponent;
  };

  return enhance;
};
