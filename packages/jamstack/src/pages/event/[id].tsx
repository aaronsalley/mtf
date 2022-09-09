import type { NextPage } from 'next';
import Helmet from '../../components/atoms/Helmet';
import EventPage from '../../components/templates/Event';

const Event: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <EventPage {...props} />
    </>
  );
};

export const getStaticPaths = async () => {
  const paths = [{ params: { id: '' } }];
  return {
    paths,
    fallback: true,
  };
  // try {
  //   const graphql = `{
  //     events(where: {status: PUBLISH}, first: 100) {
  //       nodes {
  //         slug
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
  //   const data = json.data;
  //   const nodes = data.events.nodes;
  //   if (!nodes) throw new Error(json.errors.map((error: any) => error.message));
  //   const paths = nodes.map((node: any) => {
  //     return { params: { id: node.slug } };
  //   });
  //   return {
  //     paths,
  //     fallback: false,
  //   };
  // } catch (error: any) {
  //   console.error(chalk.red(error.message));
  // }
};

export const getStaticProps = async ({ params: { id }, locale }: any) => {
  return { props: {} };
  // try {
  //   // TODO: get relevant data from Graph
  //   // [ ] date & time
  //   // [ ] location
  //   // [ ] cost
  //   // [ ] ticket link url
  //   const graphql = `{
  //     eventBy(slug: "${context.params.id}") {
  //       title,
  //       excerpt,
  //       content,
  //       categories {
  //         nodes {
  //           name
  //         }
  //       },
  //       tags {
  //         nodes {
  //           name
  //         }
  //       },
  //       featuredImage {
  //         node {
  //           sourceUrl
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
  //   if (json.errors) throw new Error(json.errors[0].message);
  //   const data = json.data;
  //   const { eventBy } = data;
  //   return {
  //     props: eventBy,
  //   };
  // } catch (error: any) {
  //   console.error(chalk.red(error.message));
  //   return {
  //     notFound: true,
  //   };
  // }
};

export default Event;
