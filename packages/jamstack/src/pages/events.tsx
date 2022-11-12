/* eslint-disable react/no-unknown-property */
import type { NextPage } from 'next';
import EventsPage from '../components/templates/Events';
import Page from '../components/templates/Page';
import { getEvents } from '../lib/WordPressGraph';
import Head from 'next/head';

const Events: NextPage = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  return (
    <>
      <Head>
        <title>{`Events ${props.seo.contentTypes.event.title}`}</title>
        <meta
          name="description"
          content={props.seo.contentTypes.event.metaDesc}
        />

        <meta
          property="og:type"
          content={props.seo.contentTypes.event.schemaType}
        />

        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{
            __html: props.seo.contentTypes.event.schema.raw,
          }}
        ></script>
      </Head>
      <Page {...props}>
        <EventsPage {...props?.events} />
      </Page>
    </>
  );
};

export const getStaticProps = async (context: any) => {
  try {
    const props = await getEvents();
    if (!props) throw Error('No data returned from CMS.');

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
