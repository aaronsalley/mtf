import EventRow from '../../molecules/EventRow';
import styles from './index.module.scss';

const Events = ({ content = { events: [] } }: any) => {
  if (!content.events)
    return <section>Check back later to see what`&apos;`s cooking.</section>;

  const items = content.events.map((event: any, i: number) => {
    return <EventRow key={i} {...event} />;
  });

  return (
    <section className={styles['container']}>
      <menu>menu options</menu>
      <div>{items}</div>
    </section>
  );
};

export default Events;
