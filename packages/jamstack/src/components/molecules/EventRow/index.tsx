import Image from 'next/image';
import Link from 'next/link';
import * as UTCto from '../../../lib/UTCto';
import Button from '../../atoms/Button';
import { EventItem } from '../../../schemas/event';
import styles from './index.module.scss';

const EventRow = ({
  featuredImage,
  title,
  excerpt,
  locationName,
  datetimeStart,
  datetimeEnd,
  link: { text = 'Details', url = '' },
}: EventItem) => {
  const {
    mediaType = '',
    altText = '',
    mediaItemUrl = '',
  } = featuredImage?.node ?? '';

  return (
    <article>
      <Link href={url}>
        <a className={styles['container']}>
          <div className={styles['thumbnail']}>
            <Image
              src={mediaItemUrl ?? '#'}
              alt={title + ' event thumbnail'}
              layout="fill"
              objectFit={'cover'}
            />
          </div>
          <section>
            <header>
              <h2>{title}</h2>
              <time>{UTCto.dates(datetimeStart, datetimeEnd)}</time>
              <address>{locationName}</address>
            </header>
            <div
              className={styles['summary']}
              dangerouslySetInnerHTML={{ __html: excerpt }}
            ></div>
            <footer>
              <Button text={text} />
            </footer>
          </section>
        </a>
      </Link>
    </article>
  );
};

export default EventRow;
