import Image from 'next/image';
import styles from './index.module.scss';
import Button from '../../atoms/Button';
import Link from 'next/link';
import { EventItem } from '../../../schemas/event';
import * as UTCto from '../../../lib/UTCto';

const EventTile = ({
  featuredImage,
  title,
  excerpt,
  datetimeStart,
  datetimeEnd,
  link: { text = 'Details', url = '/' },
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
          <header>
            <div className={styles['thumbnail']}>
              <Image
                src={mediaItemUrl ?? '#'} //TODO: If no image, use placeholder
                alt={title + ' event thumbnail'}
                layout="fill"
                objectFit="cover"
              />
            </div>
            <h3>{title}</h3>
          </header>
          <section>
            <time>{UTCto.dates(datetimeStart, datetimeEnd)}</time>
            <div
              className={styles['summary']}
              dangerouslySetInnerHTML={{ __html: excerpt }}
            ></div>
          </section>
          <footer>
            <Button text={text} />
          </footer>
        </a>
      </Link>
    </article>
  );
};

export default EventTile;
