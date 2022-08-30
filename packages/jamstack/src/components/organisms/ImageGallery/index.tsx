import { connect } from '../../../store';
import ImageTile from '../../molecules/ImageTile';
import styles from './index.module.scss';

interface ImageGallery {
  items?: any;
  maxColumns?: number | any[];
  gap?: number;
  filter?: string | any[];
  ownProps?: any;
}

// TODO: can this be made recursive?
const ImageGallery = ({
  items = [
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
    {},
  ],
  maxColumns = 7,
  gap = 2,
  filter = undefined,
  ownProps = {},
}: ImageGallery) => {
  if (items.length < 1) return null;

  let children: any[] = [];

  if (items && (filter || ownProps.filter)) {
    items.map((child: any, i: number) => {
      if (child.segment && child.segment.includes(filter || ownProps.filter)) {
        children.push(child);
      }
    });
  }

  if (children.length < 1) children = [...items];

  const gallery: any[] = [];
  const __columns: any = {};
  const columnCount =
    typeof maxColumns === 'number' ? maxColumns : maxColumns.length;

  // Create columns
  for (let i = 0; i < columnCount; i++) {
    __columns[`column${i}`] = [];
  }

  // Fill columns
  children.map((child: any, i: number) => {
    const imageSrc = child.avatar;
    const alt = child.fullName;
    const minHeightOverride = 263;
    const maxHeightOverride = 311;

    const tile = <ImageTile imageSrc={imageSrc} alt={alt} key={i} />;
    const bigTile = (
      <ImageTile
        imageSrc={imageSrc}
        alt={alt}
        minHeight={minHeightOverride}
        maxHeight={maxHeightOverride}
        key={i}
      />
    );

    if (children.length !== 22) {
      const columnIndex = i % columnCount;
      __columns[`column${columnIndex}`].push(tile);
    } else {
      if (i < 4) __columns[`column${0}`].push(tile);
      else if (i < 7) __columns[`column${1}`].push(tile);
      else if (i === 7) __columns[`column${2}`].push(bigTile);
      else if (i < 10) __columns[`column${2}`].push(tile);
      else if (i < 14) __columns[`column${3}`].push(tile);
      else if (i < 16) __columns[`column${4}`].push(tile);
      else if (i === 16) __columns[`column${5}`].push(bigTile);
      else if (i < 19) __columns[`column${5}`].push(tile);
      else __columns[`column${6}`].push(tile);
    }
  });

  // Fill gallery
  for (let i = 0; i < columnCount; i++) {
    gallery.push(
      <div className={styles['col']} key={i}>
        {__columns[`column${i}`]}
      </div>
    );
  }

  return (
    <section className={styles['container']}>
      <div>{gallery}</div>
    </section>
  );
};

const mapStateToProps = (state: any, ownProps: any) => {
  return {
    items: state.people,
  };
};

export default connect(mapStateToProps)(ImageGallery);
