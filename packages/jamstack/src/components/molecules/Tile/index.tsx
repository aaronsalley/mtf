import Image from 'next/image';
import styles from './index.module.scss';

interface Tile {
  src?: string;
  alt?: string;
  minHeight?: number;
  maxHeight?: number;
}

const Tile = ({ src = '', alt = '', minHeight = 181, maxHeight = 384 }) => {
  const randomNum =
    Math.floor(Math.random() * (maxHeight - minHeight + 1)) + minHeight;
  const randomHeight = (randomNum / minHeight) * 100;

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
