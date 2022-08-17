import Button from '../Button';
import Event from '../Event';
import styles from './index.module.scss';

const EventsGrid = () => {
  const title = 'Works In Progress';
  const events = [];

  let i = 0;
  while (i < 8) {
    events.push(<Event key={i} />);
    i++;
  }

  return (
    <section className={styles['container']}>
      <h2>{title}</h2>
      <div>{events}</div>
      <Button link={{ text: 'See all ' + title, url: '#' }} />
    </section>
  );
};

export default EventsGrid;
