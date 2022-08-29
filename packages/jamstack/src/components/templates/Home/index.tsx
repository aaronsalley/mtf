import EventGrid from '../../organisms/EventGrid';
import ImageGallery from '../../organisms/ImageGallery';
import ArticleGrid from '../../organisms/ArticleGrid';
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
      <EventGrid id='events' />
      <ImageGallery filter='maker' />
      <Programming id='programming' />
      <ArticleGrid />
    </main>
  );
};

export default Home;
