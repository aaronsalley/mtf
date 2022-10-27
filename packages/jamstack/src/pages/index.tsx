import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Home from '../components/templates/Home';
import { wpContent } from '../lib/getWPData';

const Index: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props.page} />
      <Home {...props} />
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const props = await wpContent();
    if (!props) throw new Error('Event data not found.');

    props['page'] = props.pages?.nodes.find((page: any) => page.uri === '/');

    return { props, revalidate: 60 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Index;
