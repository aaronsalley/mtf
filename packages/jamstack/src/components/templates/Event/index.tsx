import Image from 'next/image';
import Button from '../../atoms/Button';
import PageTitle from '../../atoms/PageTitle';
import styles from './index.module.scss';

const Event = ({
  featuredImage = '',
  title = 'Event Title',
  content = 'Body copy',
  categories = { nodes: [{ name: 'Program' }] },
  tags = { nodes: [{ name: 'Artist' }] },
  location = 'Location',
}: any) => {
  const cats: any[] =
    categories.nodes.length > 0
      ? categories.nodes.map((category: any) => category.name)
      : null;

  const artists: any[] =
    tags.nodes.length > 0 ? tags.nodes.map((tag: any) => tag.name) : null;

  return (
    <main className={styles['container']}>
      <header>
        <div className={styles['stage']}>
          <Image
            src={featuredImage.node.sourceUrl}
            alt={title}
            layout={'fill'}
            objectFit={'cover'}
            unoptimized // TODO: Optimize remote image
          />
        </div>
        <aside>
          <p>{artists.join(', ')}&apos;s</p>
          <PageTitle title={title} />
          <p>{cats}</p>
          <time>Date Time</time>
          <address>{location}</address>
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
