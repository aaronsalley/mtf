import Image from 'next/image';
import { useEffect, useState } from 'react';
import styles from './index.module.scss';

interface Tile {
  src?: string;
  alt?: string;
  minHeight?: number;
  maxHeight?: number;
}

const Tile = ({ src = '', alt = '', minHeight = 181, maxHeight = 384 }) => {
  const [randomHeight, setRandomHeight] = useState(0);
  useEffect(() => {
    const randomNum =
      Math.floor(Math.random() * (maxHeight - minHeight + 1)) + minHeight;
    const randomHeight = (randomNum / minHeight) * 100;
    setRandomHeight(randomHeight);
  }, [minHeight, maxHeight]);

  return (
    <div
      className={styles['container']}
      style={{ paddingBottom: `${randomHeight}%` }}
    >
      <Image src={src} alt={alt} />
    </div>
  );
};

export default Tile;
