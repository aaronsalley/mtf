import Link from 'next/link';
import { useRouter } from 'next/router';
import { connect } from '../../../store';
import styles from './index.module.scss';

const Nav = ({ mainMenu = [] }) => {
  const router = useRouter();
  if (!mainMenu || mainMenu.length < 1) return null;

  const links = mainMenu.map((item: any, i: number) => {
    return (
      <li key={i}>
        <Link href={item.url}>{item.link}</Link>
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

const mapStateToProps = (state: any, ownProps: any) => ({
  mainMenu: state.theme && state.theme.menus ? state.theme.menus.main : null,
});

export default connect(mapStateToProps)(Nav);
