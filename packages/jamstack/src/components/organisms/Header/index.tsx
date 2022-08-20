import Image from 'next/image';
import MegaMenu from '../../organisms/MegaMenu';
import Nav from '../../organisms/Nav';
import styles from './index.module.scss';
import Link from 'next/link';
import Message from '../../molecules/Message';
import { connect } from '../../../store';

const Header = (props: any) => {
  const AppBar = () => {
    return (
      <div className={styles['appbar']}>
        <span>
          <div className={styles['brand']}>
            <Link href='/'>
              <a>
                <Image {...props.gearIcon} alt='MTF gear icon' />
              </a>
            </Link>
          </div>
          <MegaMenu />
        </span>
      </div>
    );
  };

  return (
    <header className={styles['container']}>
      <AppBar />
      <Message text={props.message} />
      <Nav />
    </header>
  );
};

const mapStateToProps = (state: any, ownProps: any) => ({
  message: state.content.message,
  gearIcon: state.theme.logo,
});

// const mapDispatchToProps = (dispatch: any) => {
//   return {
//     toggle: () => {},
//   };
// };

export default connect(mapStateToProps)(Header);
