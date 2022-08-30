import { useState } from 'react';
import styles from './index.module.scss';

interface Message {
  text: string;
  link?: string;
}

const Message = ({ text = '', link = undefined }: Message) => {
  const [hasMessage, toggleMessage] = useState(true);

  let visibility: any = 'visible';
  if (!text || text.length < 1 || !hasMessage) visibility = 'collapse';

  return (
    <aside className={styles['container']} style={{ visibility: visibility }}>
      <span>
        {text}
        <button onClick={() => toggleMessage(!hasMessage)}>
          <i className='fa-solid fa-xmark'></i>
        </button>
      </span>
    </aside>
  );
};

export default Message;
