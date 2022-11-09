import type { NextPage } from 'next';
import Helmet from '../components/templates/Helmet';
import Page from '../components/templates/Page';
import Post from '../components/templates/Post';
import { getContent } from '../lib/WPData';

const Single: NextPage = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  return (
    <>
      <Helmet {...props.seo} />
      {props.contentTypeName === 'page' ? (
        <Page {...props}>
          <section
            className={'content'}
            dangerouslySetInnerHTML={{ __html: props.content }}
          ></section>
        </Page>
      ) : (
        <Post {...props}>
          <section
            className={'content'}
            dangerouslySetInnerHTML={{ __html: props.content }}
          ></section>
        </Post>
      )}
    </>
  );
};

export const getStaticPaths = async () => {
  try {
    const data = await getContent();
    const content = [...data.pages?.nodes, ...data.posts?.nodes];

    const paths = content
      .map((single: any) => {
        //Exclude the root page since it has its own template
        if (single.uri === '/') return;

        const slug = single?.uri.split('/').filter(Boolean);

        return { params: { slug } };
      })
      .filter(Boolean);

    if (!paths) throw new Error('No content returned from CMS.');

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
    const data = await getContent();
    const content = [...data.pages?.nodes, ...data.posts?.nodes];

    const props =
      content.find((single: any) => {
        if (single.uri === '/') return;

        return '/' + slug.join('/') + '/' === single.uri;
      }) ?? null;

    if (!props) throw new Error('Content not found.');

    return { props, revalidate: 3600 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Single;
