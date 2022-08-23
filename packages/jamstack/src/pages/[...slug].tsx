import { useEffect, useState } from 'react';
import type { NextPage } from 'next';
import Head from 'next/head';
import Page from '../components/templates/Page';

const Single: NextPage = (props: any) => {
  // console.log(props);

  // const [content, fetchContent] = useState('');
  // useEffect(() => {
  //   (async () => {
  //     try {
  //       const query = `{
  //         pageBy(pageId: 2) {
  //           id,
  //           title,
  //           content
  //         }
  //       }`;
  //       const graphQLQuery = query.replaceAll(/\s/gi, '');

  //       const res = await fetch(
  //         // `${process.env.NEXT_PUBLIC_WORDPRESS_API_URL}/wp-json/wp/v2/pages/2`,
  //         `${process.env.NEXT_PUBLIC_WORDPRESS_API_URL}/graphql?query=${graphQLQuery}`,
  //         {
  //           // mode: 'no-cors',
  //           cache: 'no-cache',
  //           headers: { 'Content-Type': 'application/json' },
  //         }
  //       );

  //       if (!res.ok) {
  //         throw new Error('Issues');
  //       }

  //       const json = await res.json();

  //       fetchContent(json.data.pageBy.content);
  //     } catch (error: any) {
  //       console.log(error.message);
  //     }
  //   })();
  // }, []);

  return (
    <>
      <Head>
        <title>Create Next App</title>
        <meta name='description' content='Generated by create next app' />
        <link rel='icon' href='/favicon.ico' />
      </Head>
      <Page />
    </>
  );
};

// export async function getStaticPaths() {
//   return {
//     paths: [{ params: { slug: ['page'] } }],
//     fallback: false, // can also be true or 'blocking'
//   };
// }

// export async function getStaticProps(context: any) {
//   try {
//     const query = `{
//       pageBy(pageId: 2) {
//         id,
//         title,
//         content
//       }
//     }`;
//     const graphQLQuery = query.replaceAll(/\s/gi, '');

//     const res = await fetch(
//       `${process.env.NEXT_PUBLIC_WORDPRESS_API_URL}/wp-json/wp/v2/pages/2`,
//       {
//         mode: 'no-cors',
//       }
//     );
//     const json = await res.json();

//     return {
//       props: { json }, // will be passed to the page component as props
//     };
//   } catch (error: any) {
//     console.log(error.message);
//   }
// }

export default Single;
