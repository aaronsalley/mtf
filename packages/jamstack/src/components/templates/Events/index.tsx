import Button from '../../atoms/Button';
import EventRow from '../../molecules/EventRow';
import styles from './index.module.scss';

const Events = ({ content = { events: [] } }: any) => {
  if (!content.events)
    return <section>Check back later to see what`&apos;`s cooking.</section>;

  const items = content.events.map((event: any, i: number) => {
    event['link'] = {
      text: 'Details',
      url: event.uri,
    };
    if (event.featuredImage.node)
      event['featuredImage'] = event.featuredImage.node.sourceUrl;
    return <EventRow key={i} {...event} />;
  });

  return (
    <section className={styles['container']}>
      {/* <menu>menu options</menu>
      Add menu to filter events */}
      <div>{items}</div>
      <Button text="See past events" />
    </section>
  );
};

export default Events;
