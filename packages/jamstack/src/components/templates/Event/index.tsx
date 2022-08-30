import Image from 'next/image';
import Button from '../../atoms/Button';
import PageTitle from '../../atoms/PageTitle';
import styles from './index.module.scss';

const Event = ({
  featuredImage = '',
  title = 'Event Title',
  content = 'Body copy',
}: any) => {
  return (
    <main className={styles['container']}>
      <header>
        <div className={styles['stage']}>
          <Image src={featuredImage} alt={title} layout={'fill'} />
        </div>
        <aside>
          <p>Byline</p>
          <PageTitle title={title} />
          <p>Category</p>
          <time>Date Time</time>
          <address>Location</address>
          <p>Cost</p>
          <Button text={'Find Tickets'} />
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
