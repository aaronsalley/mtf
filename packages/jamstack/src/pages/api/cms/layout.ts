import type { NextApiRequest, NextApiResponse } from 'next';
import {
  API_URL,
  MENUITEMS,
  NAVITEMS,
  SITE,
} from '../../../lib/WordPressGraph';

type Data = {
  name: string;
};

type Error = {
  message: string;
};

const handler = async (
  req: NextApiRequest,
  res: NextApiResponse<Data | Error>
) => {
  if (req.method !== 'GET')
    res.status(405).send({ message: 'Method not allowed.' });

  try {
    const GraphQLQuery = {
      // operationName: 'getLayoutData',
      query: `query {
          ${SITE},
          ${MENUITEMS},
          ${NAVITEMS},
        }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const wordpress = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await wordpress.json();
    if (json.errors) throw JSON.stringify(json.errors);

    const megaMenu = [];
    for (const item of json.data.menuItems.nodes) {
      if (!item.parentId) megaMenu.push(item);
    }
    json.data.menuItems.nodes = megaMenu;

    if (process.env.NODE_ENV !== 'production') console.debug(json);

    res.status(200).json(json.data);
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export default handler;
