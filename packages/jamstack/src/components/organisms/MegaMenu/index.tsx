import Image from 'next/image';
import Link from 'next/link';
import { ReactElement, useState } from 'react';
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
        <i className="fa-solid fa-bars-staggered"></i>
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
    let text: ReactElement;

    if (path !== '#') {
      text = (
        <Link href={path} target={target} title={title}>
          {label}
        </Link>
      );
    } else {
      text = <p>{label}</p>;
    }

    return (
      <li>
        {text}
        {children && children.length > 0 ? <ul>{children}</ul> : null}
      </li>
    );
  };

  const MenuItems = (props: any) => {
    if (props.length < 1) return null;

    const list: any = [];
    let sublist: any = [];
    let i = 0;

    // Loop through each entry
    for (const [key, value] of Object.entries(props) as [string, any]) {
      const children = value.childItems?.nodes;

      // At the lowest node
      if (!children?.length) {
        list.push(<MenuItem {...value} key={key} />);
      } else {
        // Do this again using children
        sublist.push(MenuItems(children));

        // Add new tree to the list
        list.push(
          <MenuItem {...value} key={key}>
            {sublist}
          </MenuItem>
        );

        // Reset the list for the next time
        sublist = [];
      }

      i++;
    }

    return <ul key={i}>{list}</ul>;
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
