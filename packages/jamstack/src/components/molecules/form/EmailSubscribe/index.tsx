import { ChangeEvent, useState } from 'react';
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
      const body: any = state;
      const options = {
        method: 'POST',
        headers: { 'content-type': 'application/json' },
        cache: 'no-cache' as RequestCache,
        body: JSON.stringify(body),
      };

      const res = await fetch('/api/marketing/addContact', options);
      if (!res.ok) throw res.statusText;

      if (res.status === 200) {
        setState(initialState); // FIXME: should clear form upon success
      }

      return;
    } catch (error) {
      console.error(error);
    }

    return;
  };

  return (
    <form
      className={`${styles['container']} input-group`}
      onSubmit={handleSubmit}
    >
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
