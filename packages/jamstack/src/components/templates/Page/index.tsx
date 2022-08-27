import styles from './index.module.scss';

interface Page {
  featuredImage: any;
  title: string;
  excerpt: string;
  template: string;
  slug: string;
  isFrontPage: boolean;
  content: string;
}

const Page = ({
  featuredImage = '',
  title = '',
  excerpt = '',
  template = '',
  slug = '',
  isFrontPage = false,
  content = '',
}: Page) => {
  const PageTitle = ({ title }: any) => {
    if (!title) return null;

    let words = title.split(' ');
    const firstWord = words[0];
    words.shift();
    words = words.join(' ');

    return (
      <>
        <span>{firstWord} </span>
        {words}
      </>
    );
  };

  return (
    <main className={styles['container']}>
      <aside className={styles['sidebar']}>
        <h1>
          <PageTitle title={title} />
        </h1>
        <div dangerouslySetInnerHTML={{ __html: excerpt }}></div>
      </aside>
      <section dangerouslySetInnerHTML={{ __html: content }}></section>
    </main>
  );
};

export default Page;
