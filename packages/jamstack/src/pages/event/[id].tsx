import chalk from 'chalk';
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
  try {
    const graphql = `{
      events(where: {status: PUBLISH}, first: 100) {
        nodes {
          id,
          title
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
    const nodes = data.events.nodes;

    if (!nodes) throw new Error(json.errors.map((error: any) => error.message));

    const params = nodes.map((node: any) => {
      return { params: { id: node.id } };
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
    // TODO: get relevant data from Graph
    const graphql = `{
      event(id: "${context.params.id}") {
        title
      }    
    }`;

    const query = graphql.replaceAll(/\s/gi, '');
    const res = await fetch(process.env.API_URL + `/graphql?query=${query}`, {
      headers: {
        'Content-Type': 'application/json',
      },
    });

    const json = await res.json();
    if (json.errors) throw new Error(json.errors[0].message);

    const data = json.data;
    const { event } = data;

    return {
      props: event,
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export default Event;
