import type { NextPage } from 'next';
import Helmet from '../components/templates/Helmet';
import Home from '../components/templates/Home';
import { API_URL, EVENTS, MAKERS, PAGES, POSTS } from '../lib/WordPressGraph';

const Index: NextPage = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  return (
    <>
      <Helmet {...props.seo} />
      <Home {...props} />
    </>
  );
};

const CMS = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getAll',
      query: `query {
        ${MAKERS},
        ${PAGES},
        ${EVENTS},
        ${POSTS}
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getStaticProps = async (context: any) => {
  try {
    const data: any = await CMS();

    if (!data) throw new Error('Data not found.');

    const page =
      data.pages?.nodes.find((page: any) => page.uri === '/') ?? null;
    if (!page) throw new Error('No homepage set.');

    const props = { ...data, ...page };

    return { props, revalidate: 60 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Index;
