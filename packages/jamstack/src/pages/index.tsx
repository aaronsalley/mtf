import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Home from '../components/templates/Home';
import { wpContent } from './lib/getWPData';

const Index: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <Home {...props} />
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const data = await wpContent();
    return { props: data };
  } catch (error) {
    return {
      notFound: true,
    };
  }
};

export default Index;
