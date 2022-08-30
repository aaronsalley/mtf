import EventGrid from '../../organisms/EventGrid';
import ImageGallery from '../../organisms/ImageGallery';
import ArticleGrid from '../../organisms/ArticleGrid';
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
        <div className={styles['stage']}>{media}</div>
        <aside>
          <span className={styles['scrollHint']}>scroll</span>
        </aside>
      </section>
      <blockquote dangerouslySetInnerHTML={{ __html: excerpt }}></blockquote>
      <EventGrid id='events' />
      <ImageGallery filter='maker' />
      <section id={'programming'} className={styles['container']}>
        <article>
          <h2>MTF Makers™</h2>
          <div>
            Our 18-month Artist-in-Residence program serves cohorts of
            groundbreaking musical theater artists in the creation of new work.
            Makers are supported through advocacy, mentorship, educational, and
            dramaturgical resources from the artistic staff in a community of
            mutual support, feedback, collaboration, and discourse.
          </div>
        </article>
        <article>
          <h2>MTFxR™</h2>
          <div>
            Key to innovation is access to new like augmented (AR), virtual (VR)
            and extended realities (XR). Through hands-on exploration and
            discovery, the creative pipelines of musical theatre makers and XR
            creators explore the possibilites of new mediums for artistic
            expression through next-generation storytelling.
          </div>
        </article>
        <article>
          <h2>Assembly Line™</h2>
          <div>
            Co-created around peer evaluation and collaborative feedback, the
            Factory’s core offers rigorous, intentional guidance in a radically
            inclusive, artist-centric suite tailored to support artistic
            development and process over product without the pressures of
            critical or commercial success — all at no cost to the artists.
          </div>
        </article>
      </section>
      <div className={styles['accordion']}>
        <ul>
          <li>R&D</li>
          <li>Factory Salon</li>
          <li>Representation Roundtables</li>
          <li>4x15™ Series</li>
          <li>Labs</li>
          <li>Concert series</li>
          <li>Rolling World Premieres</li>
        </ul>
      </div>
      <ArticleGrid />
    </main>
  );
};

export default Home;
