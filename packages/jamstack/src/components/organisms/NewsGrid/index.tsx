import { connect } from '../../../store';
import Button from '../../atoms/Button';
import Article from '../../molecules/Article';
import styles from './index.module.scss';

const NewsGrid = ({ posts = [], maxColumns = 4 }) => {
  if (!posts || posts.length < 1) return null;

  const title = 'News';
  const articles = [];
  const __columns: any = {};

  // Create columns
  for (let i = 0; i < maxColumns; i++) {
    __columns[`column${i}`] = [];
  }

  // Fill columns
  posts.map((post: any, i: any) => {
    const columnIndex = i % maxColumns;

    __columns[`column${columnIndex}`].push(<Article {...post} key={i} />);
    return;
  });

  // Fill grid
  for (let i = 0; i < maxColumns; i++) {
    articles.push(
      <div className={styles['col']} key={i}>
        {__columns[`column${i}`]}
      </div>
    );
  }

  return (
    <section className={styles['container']}>
      <div>{articles}</div>
      <Button text={'See all ' + title} url='/category/news/' />
    </section>
  );
};

const mapStateToProps = (state: any, ownProps: any) => ({
  posts: state.content ? state.content.posts : null,
});

export default connect(mapStateToProps)(NewsGrid);
