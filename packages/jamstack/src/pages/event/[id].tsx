import type { NextPage } from 'next';
import Helmet from '../../components/templates/Helmet';
import EventPage from '../../components/templates/Event';
import { getAll } from '../../lib/WPData';

const Event: NextPage = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  return (
    <>
      <Helmet {...props.seo} />
      <EventPage {...props} />
    </>
  );
};

export const getStaticPaths = async () => {
  try {
    const data = await getAll();
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
    let props = await getAll();
    if (!props) throw new Error('Event data not found.');

    props =
      props.events.nodes.find((event: any) => event.uri.match(id)) ?? null;

    return { props, revalidate: 60 };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Event;
