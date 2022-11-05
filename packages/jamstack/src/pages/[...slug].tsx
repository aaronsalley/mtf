import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Page from '../components/templates/Page';
import { getAll, getContent } from '../lib/WPData';

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
    const data = await getContent();
    if (!data) throw Error('No data returned from CMS.');

    const content = [...data.pages?.nodes, ...data.posts?.nodes];

    const paths = content
      .map((single: any) => {
        //Exclude the root page since it has its own template
        if (single.uri === '/') return;

        const slug = single?.uri.split('/').filter(Boolean);

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
    // TODO: Get only the slug page/post
    const data = await getContent();
    if (!data) throw Error('No data returned from CMS.');

    const content = [...data.pages?.nodes, ...data.posts?.nodes];

    const single =
      content.find((single: any) => {
        if (single.uri === '/') return;

        return '/' + slug.join('/') + '/' === single.uri;
      }) ?? null;

    if (!single) throw new Error('Content not found.');

    return { props: { ...data, ...single }, revalidate: 60 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Single;
