import { ChangeEvent, Dispatch, SetStateAction, useState } from 'react';
import styles from './index.module.scss';

interface Input {
  name: string;
  label: string;
  value?: string;
  type?: string;
  hidden?: boolean;
  cb?: (e: ChangeEvent<HTMLInputElement>) => void;
}

const Input = ({ name, label, value, type, hidden, cb }: Input) => {
  const [state, setState]: [string | undefined, Dispatch<SetStateAction<any>>] =
    useState(value);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    if (cb) cb(e);
    setState(e.target.value); // FIXME: react useState input lose focus
  };

  const Field = () => (
    <input
      className={`form-control ` + styles['container']}
      value={state}
      type={type}
      name={name}
      placeholder={label}
      onChange={handleChange}
      hidden={hidden}
    />
  );

  if (hidden) {
    return <Field />;
  }

  return (
    <div className="form-floating">
      <Field />
      <label htmlFor={name}>{label}</label>
    </div>
  );
};

export default Input;
