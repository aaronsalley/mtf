/* eslint-disable react/no-unknown-property */
import Head from 'next/head';

const Helmet = (props: any) => {
  if (process.env.NODE_ENV !== 'production') console.debug(props);

  const imageMeta = (
    <>
      <meta property="og:image" content={props.opengraphImage?.mediaItemUrl} />
      <meta
        property="og:image:width"
        content={props.opengraphImage?.mediaDetails.width}
      />
      <meta
        property="og:image:height"
        content={props.opengraphImage?.mediaDetails.height}
      />
      <meta property="og:image:type" content={props.opengraphImage?.mimeType} />
      <meta name="twitter:image" content={props.twitterImage?.mediaItemUrl} />
    </>
  );

  return (
    <Head>
      <title>{props.title}</title>
      <meta name="description" content={props.metaDesc} />
      <meta
        name="robots"
        content={`${props.metaRobotsNofollow}, ${props.metaRobotsNoindex}`}
      />

      {/* <link rel="canonical" href="http://aarons-macbook-pro.local:32769/" /> */}
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content={props.opengraphType} />
      <meta property="og:title" content={props.opengraphTitle} />
      <meta property="og:description" content={props.opengraphDescription} />
      <meta property="og:url" content={props.opengraphUrl} />
      <meta property="og:site_name" content={props.opengraphSiteName} />
      <meta property="article:publisher" content={props.opengraphPublisher} />
      <meta
        property="article:modified_time"
        content={props.opengraphModifiedTime}
      />
      {!props.opengraphImage ?? imageMeta}

      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:site" content="@mtfmusicals" />
      {props.twitterTitle ? (
        <meta name="twitter:title" content={props.twitterTitle} />
      ) : null}
      {props.twitterDescription ? (
        <meta name="twitter:description" content={props.twitterDescription} />
      ) : null}
      <meta name="twitter:label1" content="Est. reading time" />
      <meta name="twitter:data1" content={props.readingTime} />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: props.schema?.raw }}
      ></script>
    </Head>
  );
};

export default Helmet;

{
  /* <link rel="alternate" type="application/rss+xml" title="Musical Theatre Factory [Development] » Feed" href="http://aarons-macbook-pro.local:32769/feed/"> */
}
{
  /* <link rel="alternate" type="application/rss+xml" title="Musical Theatre Factory [Development] » Comments Feed" href="http://aarons-macbook-pro.local:32769/comments/feed/"> */
}
{
  /* <link rel="alternate" type="text/calendar" title="Musical Theatre Factory [Development] » iCal Feed" href="http://aarons-macbook-pro.local:32769/events/?ical=1"> */
}
{
  /* <link rel="alternate" type="application/rss+xml" title="Musical Theatre Factory [Development] » Sample Page Comments Feed" href="http://aarons-macbook-pro.local:32769/sample-page/feed/"> */
}
