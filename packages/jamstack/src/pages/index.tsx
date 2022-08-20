import type { NextPage } from 'next';
import Head from 'next/head';
import Home from '../components/templates/Home';

const Index: NextPage = () => {
  return (
    <>
      <Head>
        <title>Musical Theatre Factory</title>
        <meta name='description' content='Generated by create next app' />
        <link rel='icon' href='/favicon.ico' />
      </Head>

      <Home />
    </>
  );
};

export default Index;
