// https://developer.intuit.com/app/developer/qbo/docs/api/accounting/all-entities/vendor#create-a-vendor
import type { NextApiRequest, NextApiResponse } from 'next';

type Data = {
  name: string;
};

export const quickbooks = (req: NextApiRequest, res: NextApiResponse<Data>) => {
  res.status(200).json({ name: 'MTF' });
};
