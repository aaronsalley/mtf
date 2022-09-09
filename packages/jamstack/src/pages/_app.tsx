import type { AppProps } from 'next/app';
import Layout from '../components/templates/Layout';
import '../components/templates/Layout/globals.scss';
import { wpContent } from './lib/getWPData';

function MyApp({ Component, pageProps }: AppProps) {
  const { navItems, menuItems }: any = wpContent();

  return (
    <Layout>
      <Component {...{ ...navItems, ...menuItems, ...pageProps }} />
    </Layout>
  );
}

export default MyApp;
