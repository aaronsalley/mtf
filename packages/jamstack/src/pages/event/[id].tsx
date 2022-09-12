import type { NextPage } from 'next';
import Helmet from '../../components/atoms/Helmet';
import EventPage from '../../components/templates/Event';
import { wpContent } from '../../lib/getWPData';

const Event: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <EventPage {...props} />
    </>
  );
};

export const getStaticPaths = async () => {
  try {
    const data = await wpContent();
    const paths = data.events?.nodes.map((event: any) => {
      return { params: { id: event.slug } };
    });

    if (!paths) throw new Error('No events returned from CMS.');

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

export const getStaticProps = async ({ params: { id }, locale }: any) => {
  try {
    const data = await wpContent();
    const props = data.events.nodes.find((event: any) => event.uri.match(id));

    if (!props) throw new Error('Event data not found.');

    return { props };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Event;
