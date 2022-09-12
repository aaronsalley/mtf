import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import EventsPage from '../components/templates/Events';
import Page from '../components/templates/Page';
import { wpContent } from '../lib/getWPData';

const Events: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <Page {...props}>
        <EventsPage {...props} />
      </Page>
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const data = await wpContent();

    return {
      props: {
        title: 'Work in progress',
        events: data?.events.nodes ?? null,
      },
      revalidate: 60,
    };
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};

export default Events;
