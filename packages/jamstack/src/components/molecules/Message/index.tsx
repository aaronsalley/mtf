import { useState } from 'react';
import styles from './index.module.scss';

interface Message {
  text: string;
  link?: string;
}

const Message = ({ text = '', link = undefined }: Message) => {
  const [hasMessage, toggleMessage] = useState(true);

  if (!text || text.length < 1 || !hasMessage) return null;

  return (
    <aside className={styles['container']}>
      <span>
        {text} <button onClick={() => toggleMessage(!hasMessage)}>x</button>
      </span>
    </aside>
  );
};

export default Message;
