import chalk from 'chalk';
import type { NextPage } from 'next';
import Helmet from '../components/atoms/Helmet';
import Page from '../components/templates/Page';

const Single: NextPage = (props: any) => {
  return (
    <>
      <Helmet {...props} />
      <Page {...props}>
        <section dangerouslySetInnerHTML={{ __html: props.content }}></section>
      </Page>
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
    if (json.errors)
      json.errors.map((error: any) => {
        throw new Error(error.message);
      });

    const data = json.data;

    const nodes = data.pages.nodes;
    if (!nodes) throw new Error('Empty nodes.');

    const params = nodes.map((node: any) => {
      const slug = node.uri.split('/').filter(Boolean);
      return { params: { slug: slug } };
    });

    return {
      paths: params,
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
    if (json.errors)
      json.errors.map((error: any) => {
        throw new Error(error.message);
      });

    if (!json.data || !json.data.pageBy)
      throw new Error(json.errors.map((error: any) => error.message));

    return {
      props: json.data.pageBy,
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export default Single;
