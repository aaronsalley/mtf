import PageTitle from '../../atoms/PageTitle';
import styles from './index.module.scss';

export type Post = {
  title: string;
  content?: string;
  excerpt?: string;
  featuredImage?: any;
  template?: string;
  slug: string;
  isFrontPage?: boolean;
  children?: any;
};

const Post = ({ title = 'Page Title', excerpt, children }: Post) => {
  return (
    <main className={styles['container']}>
      {children}
      <aside>
        <PageTitle title={title} />
        <div dangerouslySetInnerHTML={{ __html: excerpt ?? '' }}></div>
      </aside>
    </main>
  );
};

export default Post;
