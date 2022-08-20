import Link from 'next/link';
import styles from './index.module.scss';

interface Button {
  text: string;
  url?: string | void;
}

const Button = ({ text = '', url = undefined }: Button) => {
  // interactive buttons
  if (typeof url !== 'string')
    return <button className={styles['container']}>{text}</button>;

  // a link buttons
  return (
    <Link href={url}>
      <a className={styles['container']}>{text}</a>
    </Link>
  );
};

export default Button;
