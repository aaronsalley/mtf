import { ChangeEvent, Dispatch, SetStateAction, useState } from 'react';
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
  };

  return <form className={styles['container']}></form>;
};

export default ArtistLeadForm;
