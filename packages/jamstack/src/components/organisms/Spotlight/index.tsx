import Image from 'next/image';

const Spotlight = ({ mediaType = '', altText = '', mediaItemUrl = '' }) => {
  switch (mediaType) {
    case 'image':
      return (
        <Image
          src={mediaItemUrl}
          alt={altText}
          layout="fill"
          objectFit={'cover'}
          priority
        />
      );
    case 'video':
      // TODO: load video player logic
      break;
    default:
      return null;
  }

  return null;
};

export default Spotlight;
