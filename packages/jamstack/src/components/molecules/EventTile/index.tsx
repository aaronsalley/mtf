import Image from 'next/image';
import styles from './index.module.scss';
import Button from '../../atoms/Button';
import Link from 'next/link';

interface EventTile {
  featuredImage: string;
  title: string;
  startDate?: string;
  endDate: string;
  excerpt: string;
  link: Button;
}

const EventTile = ({
  featuredImage = '',
  title = 'Event Title',
  startDate = undefined,
  endDate = '12.01.2021',
  excerpt = 'Event summary.',
  link = {
    text: 'Details',
    url: '',
  },
}: EventTile) => {
  const { text, url }: Button = link;

  return (
    <article>
      <Link href={url as any}>
        <a className={styles['container']}>
          <header>
            <div className={styles['thumbnail']}>
              <Image
                src={featuredImage} //TODO: If no image, use placeholder
                alt={title + ' event thumbnail'}
                layout="fill"
                unoptimized // TODO: optimze remote image
                objectFit="cover"
              />
            </div>
            <h3>{title}</h3>
          </header>
          <section>
            <time>{endDate}</time>
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
