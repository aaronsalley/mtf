import styles from './index.module.scss';

const PageTitle = ({ title }: any) => {
  if (!title) return null;

  let words = title.split(' ');
  const firstWord = words[0];
  words.shift();
  words = words.join(' ');

  return (
    <h1 className={styles['container']}>
      <span>{firstWord} </span>
      {words}
    </h1>
  );
};

export default PageTitle;
