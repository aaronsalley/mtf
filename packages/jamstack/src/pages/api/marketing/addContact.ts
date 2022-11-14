// https://mailchimp.com/developer/marketing/api/list-members/update-list-member/
import type { NextApiRequest, NextApiResponse } from 'next';

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
  if (req.method !== 'POST')
    res.status(405).json({ message: 'Method not allowed.' });

  try {
    const { email } = req.body;

    const DC = process.env.MAILCHIMP_DATA_CENTER;
    const API_KEY = process.env.MAILCHIMP_API_KEY;
    const LIST_ID = process.env.MAILCHIMP_AUDIENCE_ID;

    const headers = {
      Authorization: `Bearer ${API_KEY}`,
    };
    const body: BodyInit = JSON.stringify({
      email_address: email,
      status_if_new: 'subscribed',
      status: 'subscribed',
      source: 'website',
      marketing_permissions: [
        // Email
        { marketing_permission_id: '3b8b1bb8af', enabled: true },
        // Direct Mail
        { marketing_permission_id: '4e08e1691e', enabled: true },
        // Online advertising
        { marketing_permission_id: 'cb537bb9ce', enabled: true },
      ],
    });
    const mailchimp = await fetch(
      `https://${DC}.api.mailchimp.com/3.0/lists/${LIST_ID}/members/${email}`,
      {
        method: 'PUT',
        headers,
        body,
      }
    );

    const json = await mailchimp.json();
    if (json.errors)
      throw json.errors.map(({ field, message }: any) => {
        return `${field} — ${message}`;
      });

    if (process.env.NODE_ENV !== 'production') console.debug(json);

    res.status(200).json({ message: 'Done' });
  } catch (error: any) {
    console.error(error.message);
  }
};

export default handler;
