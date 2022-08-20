import styles from './index.module.scss';

const Hero = () => (
  <section className={styles['container']}>
    <div className={styles['stage']}>
      <p className={styles['scrollHint']}>scroll</p>
    </div>
  </section>
);

export default Hero;
