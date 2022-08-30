import Image from 'next/image';
import Link from 'next/link';
import { useState } from 'react';
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

const MegaMenu = ({
  withButton = false,
  menuData = {
    nodes: [],
  },
}: any) => {
  const styleNames = ['container'];

  const [menuVisible, setVisible] = useState(false);
  if (menuVisible) styleNames.push('--isVisible');

  const MenuToggler = ({ button, state, action }: any) => {
    // const [openMenu, toggle] = useState(false);

    if (!button) return null;

    return (
      <button onClick={() => action(!state)}>
        <i className='fa-solid fa-bars-staggered'></i>
      </button>
    );
  };

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

    return <ul key={-1}>{nestedList}</ul>;
  };

  return (
    <menu className={styles[`${styleNames.join('')}`]}>
      <MenuToggler
        button={withButton}
        state={menuVisible}
        action={setVisible}
      />
      <MenuItems {...menuData.nodes} />
    </menu>
  );
};

export default MegaMenu;
