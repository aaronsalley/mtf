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
  const programService: any[] =
    categories.nodes.length > 0
      ? categories.nodes.map((category: any) => category.name)
      : null;

  const artists: any[] =
    tags.nodes.length > 0
      ? tags.nodes.map((tag: any) => tag.name).join(', ')
      : null;

  return (
    <main className={styles['container']}>
      <header>
        <div className={styles['stage']}>
          <Image
            src={featuredImage?.node.sourceUrl}
            alt={title}
            layout={'fill'}
            objectFit={'cover'}
            unoptimized // TODO: Optimize remote image
          />
        </div>
        <aside>
          {!artists ?? <p className={styles['artists']}>{artists}&apos;s</p>}
          <PageTitle title={title} />
          <p className={styles['programService']}>{programService}</p>
          <time className={styles['time']}>
            <strong>Date</strong> Time
          </time>
          <address className={styles['location']}>{location}</address>
          <p className={styles['cost']}>Cost</p>
          <Button text={'Find Tickets'} /> {/* Hide if past */}
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
