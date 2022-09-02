import Button from '../../atoms/Button';
import MegaMenu from '../MegaMenu';
import styles from './index.module.scss';

const Footer = ({ menuData }: any) => {
  const thisYear = new Date().getFullYear();

  return (
    <footer className={styles['container']}>
      <div className={styles['devo']}>
        <a
          className={styles['guidestar']}
          href="https://www.guidestar.org/profile/47-1254076"
        />
        <a
          className={styles['amazonsmile']}
          href="https://smile.amazon.com/ch/47-1254076"
        />
        <p>
          Musical Theatre Factory, Inc. (EIN 47-1254076) is a registered
          501(c)(3) Public Charity incorporated in the State of New York. All
          donations are tax-deductible to the fullest extent under the law.
        </p>
        <form className={'input-group'}>
          <div className="form-floating">
            <input
              type="email"
              id="email"
              placeholder="name@example.com"
              className={'form-control'}
            />
            <label htmlFor="email">Email address</label>
          </div>
          <Button text={'Sign up'} />
        </form>
      </div>
      <MegaMenu menuData={menuData} />
      <p className={styles['copyright']}>
        The gear logo and all lines of programming are ™ and ©{thisYear + ' '}
        Musical Theatre Factory Inc. All Rights Reserved.
      </p>
    </footer>
  );
};

export default Footer;
