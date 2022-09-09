import Footer from '../../organisms/Footer';
import Header from '../../organisms/Header';

const Layout = ({ navItems, menuItems, children }: any) => {
  return (
    <>
      <Header menuData={{ navItems, menuItems }} />
      {children}
      <Footer menuData={menuItems} />
    </>
  );
};

export default Layout;
