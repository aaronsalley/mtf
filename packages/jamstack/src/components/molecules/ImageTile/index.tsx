import Image from 'next/image';
import { useEffect, useState } from 'react';
import styles from './index.module.scss';

interface ImageTile {
  imageSrc: string;
  alt: string;
  minHeight?: number;
  maxHeight?: number;
}

const ImageTile = ({
  imageSrc = '',
  alt = '',
  minHeight = 181,
  maxHeight = 384,
}: ImageTile) => {
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
      <Image src={imageSrc} alt={alt} layout="fill" />
    </div>
  );
};

export default ImageTile;
