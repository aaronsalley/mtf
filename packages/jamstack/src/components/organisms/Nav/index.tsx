import Link from 'next/link';
import { useRouter } from 'next/router';
import styles from './index.module.scss';

const Nav = ({ menuData = { nodes: [] } }: any) => {
  const router = useRouter();
  if (menuData === undefined || menuData['nodes'].length < 1) return null;

  const links = menuData.nodes.map((item: any, i: number) => {
    return (
      <li key={i}>
        <Link href={item.path}>{item.label}</Link>
      </li>
    );
  });

  return (
    <nav
      className={
        styles[`container--${router.route === '/' ? 'dark' : 'light'}`]
      }
    >
      <ul>{links}</ul>
    </nav>
  );
};

export default Nav;
