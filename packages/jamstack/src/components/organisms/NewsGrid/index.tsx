import Button from '../../atoms/Button';
import Article from '../../molecules/Article';
import styles from './index.module.scss';

const NewsGrid = ({ children = [1, 2, 3, 4, 5, 6, 7], maxColumns = 4 }) => {
  if (children.length < 1) return null;

  const title = 'News';
  const articles = [];
  const __columns: any = {};

  // Create columns
  for (let i = 0; i < maxColumns; i++) {
    __columns[`column${i}`] = [];
  }

  // Fill columns
  for (let i = 0; i < children.length; i++) {
    const minHeightOverride = 263;
    const maxHeightOverride = 311;

    const columnIndex = i % maxColumns;
    __columns[`column${columnIndex}`].push(<Article key={i} />);
  }

  // Fill gallery
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
      <Button link={{ text: 'See all ' + title, url: '#' }} />
    </section>
  );
};

export default NewsGrid;
