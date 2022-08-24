import Head from 'next/head';

const Helmet = ({ title, summary }: any) => (
  <Head>
    <title>{title}</title>
    <meta name='description' content={summary} />
  </Head>
);

export default Helmet;
