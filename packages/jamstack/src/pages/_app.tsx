import type { AppProps } from 'next/app';
import Layout from '../components/templates/Layout';
import { wpContent } from './lib/getWPData';
import '../components/templates/Layout/globals.scss';

function MyApp({ Component, pageProps }: AppProps) {
  const { navItems, menuItems }: any = wpContent();

  return (
    <Layout {...{ ...navItems, ...menuItems, ...pageProps }}>
      <Component {...pageProps} />
    </Layout>
  );
}

export default MyApp;
