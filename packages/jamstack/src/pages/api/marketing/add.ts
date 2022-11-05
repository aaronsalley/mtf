// Next.js API route support: https://nextjs.org/docs/api-routes/introduction
import type { NextApiRequest, NextApiResponse } from 'next';

type Data = {
  name: string;
};

type Error = {
  message: string;
};

export default function handler(
  req: NextApiRequest,
  res: NextApiResponse<Data | Error>
) {
  if (req.method !== 'POST')
    res.status(405).send({ message: 'Only POST allowed.' });

  const { email } = req.body;

  //TODO: send to Mailchimp

  res.status(200).json({ name: email });
}
