import Button from '../../atoms/Button';
import EventTile from '../../molecules/EventTile';
import styles from './index.module.scss';

const EventGrid = ({
  events = [{}, {}, {}, {}, {}, {}, {}, {}],
  id = undefined,
  ownProps,
}: any) => {
  if (!events || events.length < 1) return null;

  const title = 'Works In Progress';

  const items = events.map((event: any, i: number) => {
    while (i < 8) {
      event['link'] = { text: 'Details', url: event?.uri };
      return <EventTile {...event} key={i} />;
    }
  });

  return (
    <section id={id || ownProps.id} className={styles['container']}>
      <h2>{title}</h2>
      <div>{items}</div>
      <Button text={'See all ' + title} url={'/events'} />
    </section>
  );
};

export default EventGrid;
