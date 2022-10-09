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
    let i = 0;

    for (const [key, value] of Object.entries(props) as [string, any]) {
      const nodes: any = [];
      const children = value.childItems?.nodes;

      if (children) {
        nodes.push(MenuItems({ ...children }));
      }

      list.push(
        <MenuItem {...value} key={key}>
          {nodes}
        </MenuItem>
      );

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
