import Link from 'next/link';
import styles from './index.module.scss';

interface Button {
  text: string;
  url?: string | void;
  submit?: any | void;
}

const Button = ({ text = 'Label', url, submit }: Button) => {
  // interactive buttons
  if (typeof url !== 'string')
    return (
      <button
        type={submit ? 'submit' : 'button'}
        className={styles['container']}
      >
        {text}
      </button>
    );

  // a link buttons
  return (
    <Link href={url}>
      <a type="button" className={styles['container']}>
        {text}
      </a>
    </Link>
  );
};

export default Button;
