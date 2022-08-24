import EventsGrid from '../../organisms/EventsGrid';
import Hero from '../../organisms/Hero';
import Gallery from '../../organisms/Gallery';
import NewsGrid from '../../organisms/NewsGrid';
import Programming from '../../organisms/Programming';
import Page from '../Page';

const Home = ({
  featuredImage = '',
  title = 'ABOUT musical theatre factory',
  summary = `We develop changemaking new musicals in a joyous, collaborative community free from commercial constraints. 
  
  We are committed to dismantling oppressive ideologies toward collective liberation, centering artists of excellence who exist in the intersections of underrepresented groups.`,
  template = '',
  slug = '',
  isFrontPage = false,
  content = '',
}: Page) => {
  return (
    <main>
      <Hero />
      <blockquote style={{ height: '262px', width: '50%', marginLeft: '40%' }}>
        MTF is an accessible and brave creative space where all artists of all
        backgrounds at any stage of their career can be supported throughout
        their process.
      </blockquote>
      <EventsGrid id='events' />
      <Gallery filter='maker' />
      <Programming id='programming' />
      <NewsGrid />
    </main>
  );
};

export default Home;
