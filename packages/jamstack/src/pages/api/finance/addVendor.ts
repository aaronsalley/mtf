// https://developer.intuit.com/app/developer/qbo/docs/api/accounting/all-entities/vendor#create-a-vendor
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
    console.debug(req.body);

    const {
      fname: GivenName,
      lname: FamilyName,
      pname,
      pronouns,
      dba: CompanyName,
      TIN: TaxIdentifier,
      email: PrimaryEmailAddr,
      phone: PrimaryPhone,
      street: Line1,
      city: City,
      state: CountrySubDivisionCode,
      zip: PostalCode,
      country: Country,
    } = await req.body;

    const body = {
      GivenName,
      FamilyName,
      CompanyName,
      TaxIdentifier,
      PrimaryEmailAddr: {
        Address: PrimaryEmailAddr,
      },
      PrimaryPhone: {
        FreeFormNumber: PrimaryPhone,
      },
      BillAddr: {
        City,
        Country,
        Line1,
        PostalCode,
        CountrySubDivisionCode,
      },
    };

    res.status(200).json({});
    return;
  } catch (error: any) {
    console.error(error.message);
  }
};

export default handler;
