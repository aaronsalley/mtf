import { connect } from '../../../store';
import Button from '../../atoms/Button';
import Event from '../../molecules/Event';
import styles from './index.module.scss';

const EventsGrid = ({ events = [], id = undefined, ownProps }: any) => {
  if (!events || events.length < 1) return null;

  const title = 'Works In Progress';
  const items = events.map((event: any, i: number) => {
    while (i < 8) {
      return <Event {...event} key={i} />;
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

const mapStateToProps = (state: any, ownProps: any) => ({
  events: state.content ? state.content.events : null,
});

export default connect(mapStateToProps)(EventsGrid);
