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

const Input = ({ name, label, value, type, hidden, cb }: Input): any => {
  const [state, setState]: [string | undefined, Dispatch<SetStateAction<any>>] =
    useState(value);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    setState(e.target.value);

    if (cb) cb(e); // HACK to pass back up
  };

  if (hidden) {
    return (
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
  }

  return (
    <div className="form-floating">
      <input
        className={`form-control ` + styles['container']}
        value={state}
        type={type}
        name={name}
        placeholder={label}
        onChange={handleChange}
        hidden={hidden}
      />
      <label htmlFor={name}>{label}</label>
    </div>
  );
};

export default Input;
