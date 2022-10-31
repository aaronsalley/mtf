import { Dispatch, SetStateAction, useEffect, useState } from 'react';
import { layoutData } from '../../../lib/getLayoutData';
import Footer from '../../organisms/Footer';
import Header from '../../organisms/Header';

const Layout = ({ children }: any) => {
  const [menus, setMenus]: [any, Dispatch<SetStateAction<{}>>] = useState({});
  useEffect(() => {
    (async () => {
      const { navItems, menuItems }: any = await layoutData();
      setMenus({ navItems, menuItems });
    })();
  }, []);

  return (
    <>
      <Header menuData={menus ?? null} />
      {children}
      <Footer menuData={menus?.menuItems} />
    </>
  );
};

export default Layout;
