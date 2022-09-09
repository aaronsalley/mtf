import { Dispatch, useEffect, useState } from 'react';
import { wpContent } from '../../../pages/lib/getWPData';
import Footer from '../../organisms/Footer';
import Header from '../../organisms/Header';

const Layout = ({ children }: any) => {
  const [menuData, loadMenuData]: [any, Dispatch<any>] = useState([]);
  useEffect(() => {
    (async () => {
      try {
        const { navItems, menuItems } = await wpContent();
        loadMenuData({ navItems, menuItems });
      } catch (error: any) {
        console.error(error.message);
      }
    })();
  }, []);

  return (
    <>
      <Header menuData={menuData} />
      {children}
      <Footer menuData={menuData.menuItems} />
    </>
  );
};

export default Layout;
