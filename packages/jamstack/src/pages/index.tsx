import type { NextPage } from 'next';
import Helmet from '../components/templates/Helmet';
import Home from '../components/templates/Home';
import { getAll } from '../lib/WPData';

const Index: NextPage = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  return (
    <>
      <Helmet {...props.seo} />
      <Home {...props} />
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const data: any = await getAll();
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
