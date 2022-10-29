import { useEffect, useState } from 'react';
import Button from '../../../atoms/Button';
import styles from './index.module.scss';

const MarketingEmailRegistration = () => {
  const [email, setEmail] = useState('');

  const handleInput = (e: any) => {
    return;
  };

  const style = ['input-group'];
  style.push(styles['mereg']);

  return (
    <form className={style.join(' ')}>
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
      <Button text={'Sign up'} />
    </form>
  );
};

export default MarketingEmailRegistration;
