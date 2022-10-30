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
        <EventsPage {...props?.events} />
      </Page>
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const props = await wpContent();
    if (!props) throw Error('No data returned from CMS.');

    props['title'] = 'Work in progress';

    return {
      props,
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
