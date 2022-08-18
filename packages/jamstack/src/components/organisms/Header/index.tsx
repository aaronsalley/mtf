import Image from 'next/image';
import MegaMenu from '../../organisms/MegaMenu';
import Nav from '../../organisms/Nav';
import styles from './index.module.scss';
import gearIcon from '../../../../public/images/mtf_gear_icon.svg';

const Header = () => {
  const AppBar = () => {
    return (
      <div className={styles['appbar']}>
        <span>
          <div className={styles['brand']}>
            <Image src={gearIcon} alt='MTF gear icon' />
          </div>
          <MegaMenu />
        </span>
      </div>
    );
  };

  const Message = ({ copy = '' }) => {
    return (
      <aside className={styles['message']}>
        <span>
          {copy} <button>x</button>
        </span>
      </aside>
    );
  };

  return (
    <header className={styles['container']}>
      <AppBar />
      <Message copy='important message' />
      <Nav />
    </header>
  );
};

export default Header;
