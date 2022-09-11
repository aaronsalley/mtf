import Link from 'next/link';
import styles from './index.module.scss';

const Nav = ({ menuData = { nodes: [] } }: any) => {
  if (menuData === undefined || menuData['nodes'].length < 1) return null;

  const links = menuData.nodes.map(
    (item: any, i: number): React.ReactElement => {
      return (
        <li key={i}>
          <Link href={item.path}>{item.label}</Link>
        </li>
      );
    }
  );

  return (
    <nav className={styles['container']}>
      <ul>{links}</ul>
    </nav>
  );
};

export default Nav;
