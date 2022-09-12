import ImageTile from '../../molecules/ImageTile';
import styles from './index.module.scss';

// TODO: can this be made recursive?
// TODO: add motion on scroll
const ImageGallery = ({ items = [], maxColumns = 7, gap = 2 }) => {
  if (items.length < 1) return null;

  const gallery: any[] = [];
  const columns: any = {};

  // Create columns
  for (let i = 0; i < maxColumns; i++) {
    columns[`column${i}`] = [];
  }

  // Fill columns
  items.map((item: any, i: number) => {
    const {
      title,
      mediaType = '',
      altText = '',
      mediaItemUrl = '',
    } = item ?? '';

    const minHeightOverride = 263;
    const maxHeightOverride = 311;
    const alt = [altText, title].join(' ');

    const tile = <ImageTile src={mediaItemUrl} alt={alt} key={i} />;
    const bigTile = (
      <ImageTile
        src={mediaItemUrl}
        alt={alt}
        minHeight={minHeightOverride}
        maxHeight={maxHeightOverride}
        key={i}
      />
    );

    if (items.length !== 22) {
      const columnIndex = i % maxColumns;
      columns[`column${columnIndex}`].push(tile);
    } else {
      if (i < 4) columns[`column${0}`].push(tile);
      else if (i < 7) columns[`column${1}`].push(tile);
      else if (i === 7) columns[`column${2}`].push(bigTile);
      else if (i < 10) columns[`column${2}`].push(tile);
      else if (i < 14) columns[`column${3}`].push(tile);
      else if (i < 16) columns[`column${4}`].push(tile);
      else if (i === 16) columns[`column${5}`].push(bigTile);
      else if (i < 19) columns[`column${5}`].push(tile);
      else columns[`column${6}`].push(tile);
    }
  });

  // Fill gallery
  for (let i = 0; i < maxColumns; i++) {
    gallery.push(
      <div className={styles['col']} key={i}>
        {columns[`column${i}`]}
      </div>
    );
  }

  return (
    <section className={styles['container']}>
      <div>{gallery}</div>
    </section>
  );
};

export default ImageGallery;
