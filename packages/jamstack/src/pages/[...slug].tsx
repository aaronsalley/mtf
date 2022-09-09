import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Page from '../components/templates/Page';
import { wpContent } from './lib/getWPData';

const Single: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <Page {...props}>
        <section
          className={'content'}
          dangerouslySetInnerHTML={{ __html: props.content }}
        ></section>
      </Page>
    </>
  );
};

export const getStaticPaths = async () => {
  try {
    const data = await wpContent();
    const paths = data.pages.nodes.map((page: any) => {
      const slug = page?.uri.split('/').filter(Boolean);

      return { params: { slug } };
    });

    return {
      paths,
      fallback: true,
    };
  } catch (error: any) {
    console.error(error.message);
  }
};

export const getStaticProps = async ({ params: { slug }, locale }: any) => {
  try {
    const data = await wpContent();
    const props = data.pages.nodes.find((page: any) =>
      page.uri.match(slug.join('/'))
    );

    return { props };
  } catch (error: any) {
    console.error(error.message);
  }
};

export default Single;
