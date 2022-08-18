import Button from '../../atoms/Button';
import styles from './index.module.scss';

interface Article {
  title: string;
  pubDate: string;
  summary: string;
  link: {
    text: string;
    url: string;
  };
}

const Article = ({
  title = 'Article title',
  pubDate = '12.01.2021',
  summary = 'This is the article copy.',
  link = { text: 'Read more', url: '#' },
}: Article) => {
  return (
    <article className={styles['container']}>
      <header>
        <h3>{title}</h3>
      </header>
      <main>
        <time>{pubDate}</time>
        <div className={styles['summary']}>{summary}</div>
      </main>
      <footer>
        <Button link={link} />
      </footer>
    </article>
  );
};

export default Article;
