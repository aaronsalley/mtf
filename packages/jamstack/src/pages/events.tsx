import chalk from 'chalk';
import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';

const Events: NextPage = (props: any) => {
  console.debug(props);
  return (
    <>
      <Helmet {...props} />
    </>
  );
};

// export const getStaticProps = async (context: any) => {
//   try {
//     const graphql = `{
//       pageBy(uri: "/") {
//         title,
//         content,
//         excerpt,
//         featuredImage {
//           node {
//             mediaType,
//             mediaItemUrl,
//             altText,
//           }
//         },
//       }
//     }`;

//     const query = graphql.replaceAll(/\s/gi, '');
//     const res = await fetch(process.env.API_URL + `/graphql?query=${query}`, {
//       headers: {
//         'Content-Type': 'application/json',
//       },
//     });

//     const json = await res.json();
//     const data = json.data;

//     if (!data || !data.pageBy)
//       throw new Error(json.errors.map((error: any) => error.message));

//     data.pageBy['featuredImage'] = data.pageBy.featuredImage.node;

//     return {
//       props: data.pageBy,
//     };
//   } catch (error: any) {
//     console.error(chalk.red(error.message));
//   }
// };

export default Events;
