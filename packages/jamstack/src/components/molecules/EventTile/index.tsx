import Image from 'next/image';
import styles from './index.module.scss';
import Button from '../../atoms/Button';

interface EventTile {
  thumbnail: string;
  title: string;
  startDate?: string;
  endDate: string;
  summary: string;
  link: Button;
}

const EventTile = ({
  thumbnail = '',
  title = 'Event Title',
  startDate = undefined,
  endDate = '12.01.2021',
  summary = 'Event summary.',
  link = {
    text: 'Details',
    url: '#',
  },
}: EventTile) => {
  const { text, url }: Button = link;

  //TODO: If no image, use placeholder

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
        <Button text={text} url={url} />
      </footer>
    </article>
  );
};

export default EventTile;
