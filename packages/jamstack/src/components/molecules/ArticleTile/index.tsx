import Link from 'next/link';
import Button from '../../atoms/Button';
import styles from './index.module.scss';

interface ArticleTile {
  title: string;
  date: string;
  excerpt: string;
  link: Button;
}

const ArticleTile = ({
  title = 'The Headline',
  date = '12.01.2021',
  excerpt = 'This is the teaser copy.',
  link = { text: 'Read more', url: '#' },
}: ArticleTile) => {
  const { text, url }: Button = link;

  return (
    <article className={styles['container']}>
      <Link href={url as any}>
        <a>
          <header>
            <h3>{title}</h3>
          </header>
          <section>
            <time>{date}</time>
            <div
              className={styles['summary']}
              dangerouslySetInnerHTML={{ __html: excerpt }}
            ></div>
          </section>
          <footer>
            <Button text={text} />
          </footer>
        </a>
      </Link>
    </article>
  );
};

export default ArticleTile;
