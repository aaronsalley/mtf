import Button from '../../atoms/Button';
import styles from './index.module.scss';

interface ArticleTile {
  title: string;
  pubDate: string;
  summary: string;
  link: Button;
}

const ArticleTile = ({
  title = 'The Headline',
  pubDate = '12.01.2021',
  summary = 'This is the teaser copy.',
  link = { text: 'Read more', url: '#' },
}: ArticleTile) => {
  const { text, url }: Button = link;

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
        <Button text={text} url={url} />
      </footer>
    </article>
  );
};

export default ArticleTile;
