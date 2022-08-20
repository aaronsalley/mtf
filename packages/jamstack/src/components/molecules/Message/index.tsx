import { useState } from 'react';
import styles from './index.module.scss';

const Message = ({ text = '' }) => {
  const [hasMessage, toggleMessage] = useState(true);

  if (text.length < 1 || !hasMessage) return null;

  return (
    <aside className={styles['container']}>
      <span>
        {text} <button onClick={() => toggleMessage(!hasMessage)}>x</button>
      </span>
    </aside>
  );
};

export default Message;
