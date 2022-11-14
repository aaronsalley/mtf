import Link from 'next/link';
import styles from './index.module.scss';

interface Button {
  text: string;
  url?: string | void;
  submit?: boolean;
  action?: () => {};
}

const Button = ({ text = 'Label', url, submit, action }: Button) => {
  // interactive buttons
  if (typeof url !== 'string')
    return (
      <button
        type={submit ? 'submit' : 'button'}
        className={styles['container']}
        onClick={action ?? undefined}
      >
        {text}
      </button>
    );

  // a link buttons
  const target = url.match(/^((http(s)?:\/\/mtf.nyc)?\/)/g)
    ? undefined
    : '_blank';

  return (
    <Link href={url}>
      <a type="button" className={styles['container']} target={target}>
        {text}
      </a>
    </Link>
  );
};

export default Button;
