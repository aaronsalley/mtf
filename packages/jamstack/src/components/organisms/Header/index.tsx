import Image from 'next/image';
import MegaMenu from '../../organisms/MegaMenu';
import Nav from '../../organisms/Nav';
import styles from './index.module.scss';
import Link from 'next/link';
import Message from '../../molecules/Message';
import { connect } from '../../../store';

const Header = ({ gearIcon = {}, message = '' }: any) => {
  const AppBar = () => (
    <div className={styles['appbar']}>
      <span>
        <div className={styles['brand']}>
          <Link href='/'>
            <a>
              <Image {...gearIcon} alt='MTF gear icon' />
            </a>
          </Link>
        </div>
        <MegaMenu />
      </span>
    </div>
  );

  return (
    <header className={styles['container']}>
      <AppBar />
      <Message text={message} />
      <Nav />
    </header>
  );
};

const mapStateToProps = (state: any, ownProps: any) => ({
  message: state.content ? state.content.message : null,
  gearIcon: state.theme ? state.theme.logo : null,
});

// const mapDispatchToProps = (dispatch: any) => {
//   return {
//     toggle: () => {},
//   };
// };

export default connect(mapStateToProps)(Header);
