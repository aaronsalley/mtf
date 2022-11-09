import { ChangeEvent, useState } from 'react';
import Button from '../../../atoms/Button';
import Input from '../../../atoms/Input';
import styles from './index.module.scss';

const DonorLeadForm = () => {
  const initialState = {};
  const [state, setState] = useState(initialState);

  const handleChange = (e: ChangeEvent<HTMLInputElement>): void => {
    const { name, value } = e.target;
    setState({ ...state, [name]: value });
  };

  const handleSubmit = async (e: any): Promise<void> => {
    e.preventDefault();

    // TODO: enter donor into Kindful
    try {
    } catch (error) {}
  };

  return (
    <form className={styles['container']} onSubmit={handleSubmit}>
      <Button text={'Sign up'} submit />
    </form>
  );
};

export default DonorLeadForm;
