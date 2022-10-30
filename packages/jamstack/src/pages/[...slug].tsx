import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Page from '../components/templates/Page';
import { wpContent } from '../lib/getWPData';

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
    const paths = data.pages?.nodes
      .map((page: any) => {
        //Exclude the root page since it has its own template
        if (page.uri === '/') return;

        const slug = page?.uri.split('/').filter(Boolean);

        return { params: { slug } };
      })
      .filter(Boolean);

    if (!paths) throw new Error('No pages returned from CMS.');

    return {
      paths,
      fallback: 'blocking',
    };
  } catch (error: any) {
    console.error(error.message);

    return {
      paths: [],
      fallback: true,
    };
  }
};

export const getStaticProps = async ({ params: { slug }, locale }: any) => {
  try {
    const data = await wpContent();
    if (!data) throw Error('No data returned from CMS.');

    const page =
      data.pages?.nodes.find((page: any) => {
        if (page.uri === '/') return;

        return '/' + slug.join('/') + '/' === page.uri;
      }) ?? null;
    if (!page) throw new Error('Page not found.');

    const props = { ...data, ...page };

    if (process.env.NODE_ENV !== 'production') console.debug(props);

    return { props, revalidate: 60 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Single;
