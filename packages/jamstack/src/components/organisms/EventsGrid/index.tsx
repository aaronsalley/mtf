import { connect } from '../../../store';
import Button from '../../atoms/Button';
import Event from '../../molecules/Event';
import styles from './index.module.scss';

const EventsGrid = ({ events = [] }) => {
  if (events.length < 1) return null;

  const title = 'Works In Progress';
  const items = events.map((event: any, i: number) => {
    while (i < 8) {
      return <Event {...event} key={i} />;
    }
  });

  return (
    <section className={styles['container']}>
      <h2>{title}</h2>
      <div>{items}</div>
      <Button link={{ text: 'See all ' + title, url: '#' }} />
    </section>
  );
};

const mapStateToProps = (state: any, ownProps: any) => ({
  events: state.content.events,
});

export default connect(mapStateToProps)(EventsGrid);
