import chalk from 'chalk';
import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Page from '../components/templates/Page';

const Single: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <Page {...props} />
    </>
  );
};

export const getStaticPaths = async () => {
  try {
    const graphql = `{
      pages(where: {status: PUBLISH}, first: 100) {
        nodes {
          uri,
          id
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

    if (!data || !data.pages.nodes)
      throw new Error(json.errors.map((error: any) => error.message));

    const nodes = data.pages.nodes.map((node: any) => {
      const slug = node.uri.split('/').filter(Boolean);
      return { params: { slug: slug } };
    });

    return {
      paths: nodes,
      fallback: false,
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export const getStaticProps = async (context: any) => {
  try {
    const graphql = `{
      pageBy(uri: "${context.params.slug.join('/')}") {
        title,
        content,
        excerpt
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

    return {
      props: data.pageBy,
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export default Single;
