import Image from 'next/image';
import Link from 'next/link';
import Button from '../../atoms/Button';
import styles from './index.module.scss';

const EventRow = ({
  featuredImage = '',
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
    <article>
      <Link href={url as any}>
        <a className={styles['container']}>
          <div className={styles['thumbnail']}>
            <Image
              src={featuredImage}
              alt={title + ' event thumbnail'}
              layout="fill"
              objectFit={'cover'}
              unoptimized // TODO: Optimize remote images
            />
          </div>
          <section>
            <header>
              <h2>{title}</h2>
              <time>Monday {endDate} Time </time>
              <address>Location</address>
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
