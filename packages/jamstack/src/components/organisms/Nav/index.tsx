import Link from 'next/link';
import { connect } from '../../../store';
import styles from './index.module.scss';

const Nav = ({ mainMenu = [] }) => {
  if (mainMenu.length < 1) return null;

  const links = mainMenu.map((item: any, i: number) => {
    return (
      <li key={i}>
        <Link href={item.url}>{item.link}</Link>
      </li>
    );
  });

  return (
    <nav className={styles['container']}>
      <ul>{links}</ul>
    </nav>
  );
};

const mapStateToProps = (state: any, ownProps: any) => ({
  mainMenu: state.theme.menus.main,
});

export default connect(mapStateToProps)(Nav);
