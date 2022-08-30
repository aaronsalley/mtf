import Image from 'next/image';
import MegaMenu from '../../organisms/MegaMenu';
import Nav from '../../organisms/Nav';
import styles from './index.module.scss';
import Link from 'next/link';
import Message from '../../molecules/Message';
import Brand from '../../../../public/images/mtf_gear_icon.svg';

const Header = ({
  gearIcon = Brand,
  message = 'This is a sample global message.',
  menuData,
}: any) => {
  const { menuItems: megaMenu, navItems: navMenu } = menuData;

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
        <MegaMenu withButton menuData={megaMenu} />
      </span>
    </div>
  );

  return (
    <header className={styles['container']}>
      <AppBar />
      <Message text={message} />
      <Nav menuData={navMenu} />
    </header>
  );
};

export default Header;
