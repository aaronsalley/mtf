import Link from 'next/link';
import Image from 'next/image';
import styles from './index.module.scss';
import Button from '../Button';

const Event = ({
  thumbnail = '',
  title = 'Event Title',
  startDate = '12.01.2021',
  endDate = '12.01.2021',
  summary = 'Event summary.',
  link = {
    text: 'Details',
    url: '#',
  },
}) => {
  return (
    <article className={styles['container']}>
      <header>
        <div className={styles['thumbnail']}>
          <Image
            src={thumbnail}
            alt={title + ' event thumbnail'}
            layout='fill'
          />
        </div>
        <h3>{title}</h3>
      </header>
      <main>
        <time>{endDate}</time>
        <div className={styles['summary']}>{summary}</div>
      </main>
      <footer>
        <Button link={link} />
      </footer>
    </article>
  );
};

export default Event;
