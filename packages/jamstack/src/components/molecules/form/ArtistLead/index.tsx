import { ChangeEvent, useState } from 'react';
import Button from '../../../atoms/Button';
import styles from './index.module.scss';

const ArtistLeadForm = () => {
  const initialState = {};
  const [state, setState] = useState(initialState);

  const handleChange = (e: ChangeEvent<HTMLInputElement>): void => {
    const { name, value } = e.target;
    setState({ ...state, [name]: value });
  };

  const handleSubmit = async (e: any): Promise<void> => {
    e.preventDefault();

    // TODO: enter into artist DB & subscribe to mailing list
    try {
    } catch (error) {}
  };

  return (
    <form className={styles['container']} onSubmit={handleSubmit}>
      <Button text={'Sign up'} submit />
    </form>
  );
};

export default ArtistLeadForm;
