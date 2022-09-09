import type { NextPage } from 'next';
import Helmet from '../../components/atoms/Helmet';
import EventPage from '../../components/templates/Event';
import { wpContent } from '../lib/getWPData';

const Event: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <EventPage {...props} />
    </>
  );
};

export const getStaticPaths = async () => {
  const data = await wpContent();

  const paths = data.events.nodes.map((event: any) => {
    return { params: { id: event.slug } };
  });
  return {
    paths,
    fallback: true,
  };
};

export const getStaticProps = async ({ params: { id }, locale }: any) => {
  const data = await wpContent();
  const props = data.events.nodes.find((event: any) => event.uri.match(id));

  return { props };
};

export default Event;
