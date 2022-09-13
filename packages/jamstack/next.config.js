// This file sets a custom webpack configuration to use your Next.js app
// with Sentry.
// https://nextjs.org/docs/api-reference/next.config.js/introduction
// https://docs.sentry.io/platforms/javascript/guides/nextjs/

/** @type {import('next').NextConfig} */
const { withSentryConfig } = require('@sentry/nextjs');

const nextConfig = {
  poweredByHeader: false,
  reactStrictMode: true,
  swcMinify: true,
  images: {
    domains: [
      'localhost',
      'aarons-macbook-pro.local',
      'storage.googleapis.com',
    ],
  },
};

const moduleExports = {
  ...nextConfig,
  sentry: {
    hideSourceMaps: true,
  },
  env: {
    SENTRY_DSN:
      process.env.SENTRY_DSN ||
      'https://7e0abe374a764ced9073998fb0e4a5d2@o178341.ingest.sentry.io/6670520',
    API_URL: process.env.API_URL || 'http://localhost:32769',
    NEXT_PUBLIC_API_URL:
      process.env.NEXT_PUBLIC_API_URL || 'http://localhost:32769',
  },
};

const sentryWebpackPluginOptions = {
  // Additional config options for the Sentry Webpack plugin. Keep in mind that
  // the following options are set automatically, and overriding them is not
  // recommended:
  //   release, url, org, project, authToken, configFile, stripPrefix,
  //   urlPrefix, include, ignore

  silent: true, // Suppresses all logs
  // For all available options, see:
  // https://github.com/getsentry/sentry-webpack-plugin#options.
};

// Make sure adding Sentry options is the last code to run before exporting, to
// ensure that your source maps include changes from all other Webpack plugins
// module.exports = moduleExports;
module.exports = withSentryConfig(moduleExports, sentryWebpackPluginOptions);
