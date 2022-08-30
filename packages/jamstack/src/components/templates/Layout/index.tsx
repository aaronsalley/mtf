import Context from '../../../store';
import { store } from '../../../store/state';
import Footer from '../../organisms/Footer';
import Header from '../../organisms/Header';

const Layout = ({ children }: any) => {
  // TODO: fetch state consts; move MegaMenu calls here
  return (
    <Context.Provider value={store}>
      <Header foo='bar' />
      {children}
      <Footer />
    </Context.Provider>
  );
};

export default Layout;
