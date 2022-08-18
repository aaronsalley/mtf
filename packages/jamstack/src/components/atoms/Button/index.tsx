import Link from 'next/link';
import styles from './index.module.scss';

const Button = ({ link = { text: '', url: '' } }) => {
  return (
    <Link href={link.url}>
      <a className={styles['container']}>{link.text}</a>
    </Link>
  );
};

export default Button;
