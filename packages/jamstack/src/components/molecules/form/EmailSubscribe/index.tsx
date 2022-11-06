import { useState } from 'react';
import Button from '../../../atoms/Button';
import styles from './index.module.scss';

const EmailSubscribeForm = () => {
  const style = ['input-group'];
  style.push(styles['mereg']);
  const [formData, setFormData] = useState('');

  const handleInput = (e: any): void => {
    const { value } = e.target;
    setFormData(value);

    return;
  };

  const handleSubmit = async (e: any): Promise<void> => {
    e.preventDefault();

    try {
      const body: any = { email: formData };
      const options = {
        method: 'POST',
        headers: { 'content-type': 'application/json' },
        cache: 'no-cache' as RequestCache,
        body: JSON.stringify(body),
      };

      const res = await fetch('/api/mailchimp/add', options);
      if (res.error) throw res.error;

      return;
    } catch (error) {
      console.error(error);
    }

    return;
  };

  return (
    <form className={style.join(' ')} onSubmit={handleSubmit}>
      <input name="first_name" hidden />
      <input name="last_name" hidden />
      <div className="form-floating">
        <input
          type="email"
          name="email"
          placeholder="name@example.com"
          className={'form-control'}
          onChange={handleInput}
        />
        <label htmlFor="email">Email address</label>
      </div>
      <Button text={'Sign up'} submit />
    </form>
  );
};

export default EmailSubscribeForm;
