import Link from 'next/link';
import styles from './index.module.scss';

const Nav = () => {
  return (
    <nav className={styles['container']}>
      <ul>
        <li>
          <Link href='#'>Events</Link>
        </li>
        <li>
          <Link href='#'>Programming</Link>
        </li>
      </ul>
    </nav>
  );
};

export default Nav;
