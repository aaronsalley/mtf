import Image from 'next/image';
import * as UTCto from '../../../lib/UTCto';
import Button from '../../atoms/Button';
import PageTitle from '../../atoms/PageTitle';
import { EventItem } from '../../../schemas/event';
import styles from './index.module.scss';

const Event = ({
  featuredImage,
  title,
  locationName,
  datetimeStart,
  datetimeEnd,
  isAllDay,
  excerpt,
  eventURL,
  ticketPrice,
  content,
  categories,
  tags,
}: EventItem) => {
  const {
    mediaType = '',
    altText = '',
    mediaItemUrl = '',
  } = featuredImage?.node ?? '';

  const programService: any[] =
    categories?.nodes.length > 0
      ? categories.nodes.map((category: any) => category.name)
      : null;

  const artists: any[] =
    tags?.nodes.length > 0
      ? tags.nodes.map((tag: any) => tag.name).join(', ')
      : null;

  const date =
    datetimeStart === datetimeEnd
      ? UTCto.formattedDate(datetimeStart)
      : `${UTCto.formattedDate(datetimeStart)} – ${UTCto.formattedDate(
          datetimeEnd
        )}`;

  const time = isAllDay ? 'All Day' : UTCto.formattedTime(datetimeStart);

  return (
    <main className={styles['container']}>
      <header>
        <div className={styles['stage']}>
          <Image
            src={mediaItemUrl}
            alt={title + ' event thumbnail'}
            layout="fill"
            objectFit="cover"
          />
        </div>
        <aside>
          {!artists ?? <p className={styles['artists']}>{artists}&apos;s</p>}
          <PageTitle title={title} />
          <p className={styles['programService']}>{programService}</p>
          <time className={styles['time']}>
            <strong>{date}</strong> {time}
          </time>
          <address className={styles['location']}>
            {locationName ?? 'Online'}
          </address>
          <p className={styles['cost']}>{ticketPrice}</p>
          <Button text={'Find Tickets'} url={eventURL} /> {/* Hide if past */}
          <span></span>
        </aside>
      </header>
      <section>
        <h2>Description</h2>
        <div dangerouslySetInnerHTML={{ __html: content }}></div>
      </section>
    </main>
  );
};

export default Event;
