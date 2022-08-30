import chalk from 'chalk';
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
  try {
    // TODO: get relevant data from Graph
    const graphql = `{
      events(where: {status: PUBLISH}, first: 100) {
        nodes {
          id,
          title,
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
    const nodes = data.events.nodes;

    if (!nodes) throw new Error(json.errors.map((error: any) => error.message));

    return {
      props: {
        title: 'Work in progress',
        content: { events: nodes },
      },
    };
  } catch (error: any) {
    console.error(chalk.red(error.message));
  }
};

export default Events;
