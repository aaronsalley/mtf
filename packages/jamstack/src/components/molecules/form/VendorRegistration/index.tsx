import { ChangeEvent, Dispatch, SetStateAction, useState } from 'react';
import Button from '../../../atoms/Button';
import Input from '../../../atoms/Input';
import styles from './index.module.scss';

const VendorRegistrationForm = () => {
  const initialState = {
    fname: '',
    lname: '',
    pname: '',
    pronouns: '',
    dba: '',
    TIN: '',
    email: '',
    phone: '',
    street: '',
    city: '',
    zip: '',
    country: '',
  };
  const [state, setState] = useState(initialState);

  const handleChange = (e: ChangeEvent<HTMLInputElement>): void => {
    const { name, value } = e.target;
    // setState({ ...state, [name]: value });
  };

  const handleSubmit = async (e: any): Promise<void> => {
    e.preventDefault();

    // TODO: enter into QBO & subscribe to mailing list
    // if artist & not listed, add to artist DB
  };

  const StateOptions = () => {
    const states = {
      AK: 'AK',
      AL: 'AL',
      AR: 'AR',
      AZ: 'AZ',
      CA: 'CA',
      CO: 'CO',
      CT: 'CT',
      DC: 'DC',
      DE: 'DE',
      FL: 'FL',
      GA: 'GA',
      HI: 'HI',
      IA: 'IA',
      ID: 'ID',
      IL: 'IL',
      IN: 'IN',
      KS: 'KS',
      KY: 'KY',
      LA: 'LA',
      MA: 'MA',
      MD: 'MD',
      ME: 'ME',
      MI: 'MI',
      MN: 'MN',
      MO: 'MO',
      MS: 'MS',
      MT: 'MT',
      NC: 'NC',
      ND: 'ND',
      NE: 'NE',
      NH: 'NH',
      NJ: 'NJ',
      NM: 'NM',
      NV: 'NV',
      NY: 'NY',
      OH: 'OH',
      OK: 'OK',
      OR: 'OR',
      PA: 'PA',
      RI: 'RI',
      SC: 'SC',
      SD: 'SD',
      TN: 'TN',
      TX: 'TX',
      UT: 'UT',
      VA: 'VA',
      VT: 'VT',
      WA: 'WA',
      WI: 'WI',
      WV: 'WV',
      WY: 'WY',
    };

    const options: any = [];

    for (const [key, value] of Object.entries(states)) {
      options.push(
        <option value={key} key={key}>
          {value}
        </option>
      );
    }

    return options;
  };

  return (
    <form className={styles['container']}>
      <div>
        <label>Name</label>
        <fieldset>
          <Input
            name="fname"
            label="First Name"
            value={state['fname']}
            cb={handleChange}
          />
          <Input
            name="lname"
            label="Last Name"
            value={state['lname']}
            cb={handleChange}
          />
          <Input
            name="pname"
            label="Preferred Name"
            value={state['pname']}
            cb={handleChange}
          />
          <Input
            name="pronouns"
            label="Pronouns"
            value={state['pronouns']}
            cb={handleChange}
          />
        </fieldset>
      </div>
      <div>
        <label>DBA or Company Name</label>
        <fieldset>
          <Input
            name="dba"
            label="DBA or Company Name"
            value={state['dba']}
            cb={handleChange}
          />
          <Input
            name="TIN"
            label="TIN"
            value={state['TIN']}
            cb={handleChange}
          />
        </fieldset>
      </div>
      <div>
        <label>Contact Info</label>
        <fieldset>
          <Input
            name="email"
            label="Email"
            value={state['email']}
            cb={handleChange}
          />
          <Input
            name="phone"
            label="Phone"
            value={state['phone']}
            cb={handleChange}
          />
          <Input
            name="street"
            label="Street"
            value={state['street']}
            cb={handleChange}
          />
          <Input
            name="city"
            label="City"
            value={state['city']}
            cb={handleChange}
          />
          <div className="form-floating" id={styles[`state`]}>
            <select
              className="form-select"
              name="state"
              size={1}
              defaultValue={'--'}
              placeholder="State"
            >
              <option value="--" disabled>
                State
              </option>
              <StateOptions />
            </select>
            <label>State</label>
          </div>
          <Input
            name="zip"
            label="Postal Code"
            value={state['zip']}
            cb={handleChange}
          />
          <Input
            name="country"
            label="Country"
            value={state['country']}
            cb={handleChange}
          />
        </fieldset>
      </div>
      <Button text="Submit" />
    </form>
  );
};

export default VendorRegistrationForm;
