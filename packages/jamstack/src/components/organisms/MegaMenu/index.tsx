import Link from 'next/link';
import { useEffect, useState } from 'react';
import styles from './index.module.scss';

interface menuItem {
  id: string;
  parentId: string | null;
  label: string;
  path: string;
  target?: string;
  title?: string;
  children?: any;
}

const MegaMenu = ({ button }: any) => {
  const [menuData, loadData] = useState([]);
  useEffect(() => {
    (async () => {
      try {
        const graphql = `{
          menuItems(where: {location: FOOTER, parentId: ""}, first: 1000) {
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
        const data = json.data;

        if (!data.menuItems && !data.menuItems.nodes)
          throw Error('Menu is empty.');

        loadData(data.menuItems.nodes);
      } catch (error: any) {
        console.error('Caught error: ' + error.message);
      }
    })();
  }, []);

  const MenuItem = ({
    path = '',
    target = '',
    title = '',
    label = '',
    children,
  }: menuItem) => {
    let text: any = <p>{label}</p>;

    if (path !== '#')
      text = (
        <Link href={path} target={target} title={title}>
          {label}
        </Link>
      );

    return (
      <li>
        {text}
        {children && children.length > 0 ? <ul>{children}</ul> : null}
      </li>
    );
  };

  const MenuItems = (props: any) => {
    if (props === undefined) return null;

    const nestedList: any = [];
    let i = 0;

    for (const [key, value] of Object.entries(props) as [string, any]) {
      const inner: any = [];

      if (value['childItems'] && value['childItems']['nodes'].length > 0) {
        inner.push(MenuItems({ ...value.childItems.nodes }));
      }

      nestedList.push(
        <MenuItem {...value} key={key}>
          {inner}
        </MenuItem>
      );

      i++;
    }

    return nestedList;
  };

  return (
    <menu className={styles['container']}>
      {button}
      <ul>
        <MenuItems {...menuData} />
      </ul>
    </menu>
  );
};

export default MegaMenu;
