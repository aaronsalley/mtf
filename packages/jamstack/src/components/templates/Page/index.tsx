import styles from './index.module.scss';

interface Page {
  featuredImage: string;
  title: string;
  summary: string;
  template: string;
  slug: string;
  isFrontPage: boolean;
  content: string;
}

const Page = ({
  featuredImage = '',
  title = 'ABOUT musical theatre factory',
  summary = `We develop changemaking new musicals in a joyous, collaborative community free from commercial constraints. 
  
  We are committed to dismantling oppressive ideologies toward collective liberation, centering artists of excellence who exist in the intersections of underrepresented groups.`,
  template = '',
  slug = '',
  isFrontPage = false,
  content = '',
}: Page) => {
  return (
    <main className={styles['container']}>
      <aside className={styles['sidebar']}>
        <h1>{title}</h1>
        <div>{summary}</div>
      </aside>
      <section dangerouslySetInnerHTML={{ __html: content }}></section>
    </main>
  );
};

export default Page;
