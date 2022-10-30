import Head from 'next/head';
import { useRouter } from 'next/router';

const Helmet = ({
  title,
  summary,
  siteName = 'Musical Theatre Factory',
}: any) => {
  const router = useRouter();

  const SEOTitle =
    router.pathname === '/'
      ? `${siteName} - ${title}`
      : `${title} @ ${siteName}`;

  return (
    <Head>
      <title>{SEOTitle}</title>
      <meta name="description" content={summary} />

      {/* TODO: Add SEO */}
    </Head>
  );
};

export default Helmet;
