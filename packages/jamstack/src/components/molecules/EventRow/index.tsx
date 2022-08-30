import Image from 'next/image';
import Button from '../../atoms/Button';
import styles from './index.module.scss';

const EventRow = ({
  thumbnail = '',
  title = 'Event Title',
  startDate = undefined,
  endDate = '12.01.2021',
  excerpt = 'Event summary.',
  link = {
    text: 'Details',
    url: '',
  },
}: any) => {
  const { text, url }: Button = link;

  return (
    <article className={styles['container']}>
      <div className={styles['thumbnail']}>
        <Image src={thumbnail} alt={title + ' event thumbnail'} layout='fill' />
      </div>
      <section>
        <header>
          <h3>{title}</h3>
          <time>Monday {endDate} Time </time>
          <address>Location</address>
        </header>
        <div className={styles['summary']}>{excerpt}</div>
        <footer>
          <Button text={text} url={url} />
        </footer>
      </section>
    </article>
  );
};

export default EventRow;
