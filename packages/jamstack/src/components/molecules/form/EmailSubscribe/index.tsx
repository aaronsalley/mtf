import { ChangeEvent, Dispatch, SetStateAction, useState } from 'react';
import Button from '../../../atoms/Button';
import Input from '../../../atoms/Input';
import styles from './index.module.scss';

const EmailSubscribeForm = () => {
  const initialState = {
    fname: '',
    lname: '',
    email: '',
  };
  const [state, setState] = useState(initialState);

  const handleChange = (e: ChangeEvent<HTMLInputElement>): void => {
    const { name, value } = e.target;
    setState({ ...state, [name]: value });
  };

  const handleSubmit = async (e: any): Promise<void> => {
    e.preventDefault();

    try {
      const body: any = { email: state };
      const options = {
        method: 'POST',
        headers: { 'content-type': 'application/json' },
        cache: 'no-cache' as RequestCache,
        body: JSON.stringify(body),
      };

      const res = await fetch('/api/mailchimp/add', options);
      // if (res.error) throw res.error;

      return;
    } catch (error) {
      console.error(error);
    }

    return;
  };

  const style = ['input-group'];
  style.push(styles['container']);

  return (
    <form className={style.join(' ')} onSubmit={handleSubmit}>
      <Input
        name="fname"
        label="First Name"
        value={state['fname']}
        cb={handleChange}
        hidden
      />
      <Input
        name="lname"
        label="Last Name"
        value={state['lname']}
        cb={handleChange}
        hidden
      />
      <Input
        type="email"
        name="email"
        label="Email address"
        value={state['email']}
        cb={handleChange}
      />
      <Button text={'Sign up'} submit />
    </form>
  );
};

export default EmailSubscribeForm;
