import Button from '../../atoms/Button';
import ArticleTile from '../../molecules/ArticleTile';
import styles from './index.module.scss';

const ArticleGrid = ({ posts = [], maxColumns = 4 }) => {
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
    if (i > 7) return;
    const columnIndex = i % maxColumns;

    post['link'] = { text: 'Read More', url: post.slug };

    __columns[`column${columnIndex}`].push(<ArticleTile {...post} key={i} />);
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
      <Button text={'See all ' + title} url="/category/news/" />
    </section>
  );
};

export default ArticleGrid;
