import chalk from 'chalk';
import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Home from '../components/templates/Home';

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
    // TODO: fetch Makers images
    const graphql = `{
      pageBy(uri: "/") {
        title,
        content,
        excerpt,
        featuredImage {
          node {
            mediaType,
            mediaItemUrl,
            altText,
          }
        },
      },
      events(where: {status: PUBLISH}, first: 100) {
        nodes {
          id,
          title,
          excerpt,
          uri,
          slug,
          featuredImage {
            node {
              sourceUrl
            }
          }    
        }
      },
      posts(where: {status: PUBLISH}) {
        nodes {
          date,
          title,
          slug,
          excerpt
        }
      }    
    }`;

    const query = graphql.replaceAll(/\s/gi, '');
    const res = await fetch(process.env.API_URL + `/graphql?query=${query}`, {
      headers: {
        'Content-Type': 'application/json',
      },
    });

    const json = await res.json();
    const data = json.data;

    if (!data || !data.pageBy)
      throw new Error(json.errors.map((error: any) => error.message));

    data.pageBy['featuredImage'] = data.pageBy.featuredImage.node;

    return {
      props: data,
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export default Index;
