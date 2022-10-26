import type { NextPage } from 'next';
import Helmet from '../../components/atoms/Helmet';
import EventPage from '../../components/templates/Event';
import { wpContent } from '../../lib/getWPData';

const Event: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props.event} />
      <EventPage {...props.event} />
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
    const props = await wpContent();
    if (!props) throw new Error('Event data not found.');

    props['event'] = props.events.nodes.find((event: any) =>
      event.uri.match(id)
    );

    return { props };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Event;
