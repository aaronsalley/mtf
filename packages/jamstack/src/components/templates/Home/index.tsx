import EventsGrid from '../../organisms/EventsGrid';
import Gallery from '../../organisms/Gallery';
import NewsGrid from '../../organisms/NewsGrid';
import Programming from '../../organisms/Programming';
import Page from '../Page';
import styles from './index.module.scss';
import Image from 'next/image';

const Home = ({
  featuredImage,
  title = '',
  excerpt = '',
  template = '',
  slug = '',
  isFrontPage = false,
  content = '',
}: Page) => {
  let media = null;
  const { mediaType, altText, mediaItemUrl } = featuredImage;
  switch (mediaType) {
    case 'image':
      media = (
        <Image src={mediaItemUrl} alt={altText} layout='fill' unoptimized />
      );
      break;
  }

  return (
    <main className={styles['container']}>
      <section className={styles['hero']}>
        <main className={styles['stage']}>{media}</main>
        <aside>
          <span className={styles['scrollHint']}>scroll</span>
        </aside>
      </section>
      <blockquote dangerouslySetInnerHTML={{ __html: excerpt }}></blockquote>
      <EventsGrid id='events' />
      <Gallery filter='maker' />
      <Programming id='programming' />
      <NewsGrid />
    </main>
  );
};

export default Home;
