import Image from 'next/image';
import PageTitle from '../../atoms/PageTitle';
import styles from './index.module.scss';

interface Page {
  title: string;
  content?: string;
  excerpt?: string;
  featuredImage?: any;
  template?: string;
  slug: string;
  isFrontPage?: boolean;
  children?: any;
}

const Page = ({
  title = 'Page Title',
  excerpt = '',
  slug = '',
  isFrontPage = false,
  content = '',
  children,
}: Page) => {
  return (
    <main className={styles['container']}>
      {children}
      <aside>
        <PageTitle title={title} />
        <div dangerouslySetInnerHTML={{ __html: excerpt }}></div>
      </aside>
    </main>
  );
};

export default Page;
