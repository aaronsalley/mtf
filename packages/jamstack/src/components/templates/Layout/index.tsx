import chalk from 'chalk';
import { Dispatch, useEffect, useState } from 'react';
import Footer from '../../organisms/Footer';
import Header from '../../organisms/Header';

const Layout = ({ children }: any) => {
  // TODO: fetch state consts
  const [menuData, loadMenuData]: [any, Dispatch<any>] = useState([]);
  useEffect(() => {
    (async () => {
      try {
        const graphql = `{
          menuItems(where: {location: MEGA, parentId: ""}, first: 1000) {
            nodes {
              label,
              title,
              target,
              path,
              childItems {
                nodes {
                  label,
                  title,
                  target,
                  path,
                }
              }
            }
          },
          navItems: menuItems(where: {location: NAV, parentId: ""}, first: 1000) {
            nodes {
              label,
              title,
              target,
              path,
            }
          }
        }`;

        const query = graphql.replaceAll(/\s/gi, '');
        const res = await fetch(
          process.env.NEXT_PUBLIC_API_URL + `/graphql?query=${query}`,
          {
            headers: {
              'Content-Type': 'application/json',
            },
          }
        );
        const json = await res.json();
        if (json.errors)
          json.errors.map((error: any) => {
            throw new Error(error.message);
          });

        if (!json.data.menuItems && !json.data.navItems)
          throw Error('Menu is empty.');

        loadMenuData(json.data);
      } catch (error: any) {
        console.error(chalk.red(error.message));
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
