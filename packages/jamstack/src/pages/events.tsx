import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import EventsPage from '../components/templates/Events';
import Page from '../components/templates/Page';

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
  return { props: {} };
  // try {
  //   // TODO: get relevant data from Graph
  //   // [ ] date
  //   // [ ] location
  //   const graphql = `{
  //     events(where: {status: PUBLISH}, first: 100) {
  //       nodes {
  //         id,
  //         title,
  //         excerpt,
  //         uri,
  //         slug,
  //         featuredImage {
  //           node {
  //             sourceUrl
  //           }
  //         }
  //       }
  //     }
  //   }`;
  //   const query = graphql.replaceAll(/\s/gi, '');
  //   const res = await fetch(process.env.API_URL + `/graphql?query=${query}`, {
  //     headers: {
  //       'Content-Type': 'application/json',
  //     },
  //   });
  //   const json = await res.json();
  //   if (json.errors)
  //     json.errors.map((error: any) => {
  //       throw new Error(error.message);
  //     });
  //   if (!json.data.events.nodes) throw new Error('Empty nodes.');
  //   return {
  //     props: {
  //       title: 'Work in progress',
  //       content: { events: json.data.events.nodes },
  //     },
  //   };
  // } catch (error: any) {
  //   console.error(chalk.red(error.message));
  //   return {
  //     notFound: true,
  //   };
  // }
};

export default Events;
