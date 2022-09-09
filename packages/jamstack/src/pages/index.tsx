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
    return { props: {} };
  } catch (error) {}
  // try {

  //   // TODO: fetch Makers images
  //   const graphql = `{
  //     pageBy(uri: "/") {
  //       title,
  //       content,
  //       excerpt,
  //       featuredImage {
  //         node {
  //           mediaType,
  //           mediaItemUrl,
  //           altText,
  //         }
  //       },
  //     },
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
  //     },
  //     posts(where: {status: PUBLISH}) {
  //       nodes {
  //         date,
  //         title,
  //         slug,
  //         excerpt
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

  //   if (!json.data || !json.data.pageBy) throw new Error('Empty data');

  //   json.data.pageBy['featuredImage'] = json.data.pageBy.featuredImage.node;

  //   return {
  //     props: json.data,
  //   };
  // } catch (error: any) {
  //   console.error(chalk.red(error.message));

  //   return {
  //     notFound: true,
  //   };
  // }
};

export default Index;
