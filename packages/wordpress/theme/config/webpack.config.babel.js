'use strict';

import BrowserSyncPlugin from 'browser-sync-webpack-plugin';
import CleanWebpackPlugin from 'clean-webpack-plugin';
import CopyWebpackPlugin from 'copy-webpack-plugin';
import dotenv from 'dotenv';
import Dotenv from 'dotenv-webpack';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import incstr from 'incstr';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import OptimizeCSSAssetsPlugin from 'optimize-css-assets-webpack-plugin';
import path from 'path';
import UglifyJsPlugin from 'uglifyjs-webpack-plugin';
import webpack from 'webpack';

const createUniqueIdGenerator = () => {
  const index = {};
  const generateNextId = incstr.idGenerator({
    alphabet: 'abcefghijklmnopqrstuvwxyz0123456789',
  });

  return (name) => {
    if (index[name]) {
      return index[name];
    }

    let nextId;
    do {
      nextId = generateNextId();
    } while (/^[0-9]/.test(nextId));

    index[name] = generateNextId();

    return index[name];
  };
};
const uniqueId = createUniqueIdGenerator();
const generateScopedName = (localName, resourcePath) => {
  const componentFile = resourcePath.split('/').slice(-1);
  const componentName = componentFile.toString().split('.').slice(0, 1);

  if (process.env.NODE_ENV !== 'production') {
    return localName;
    // return componentName + '_' + localName;
  } else {
    return localName;
    // return uniqueId(componentName) + '_' + uniqueId(localName);
  }
};

const config = {
  webpack: {
  },
};

config.envfile = path.resolve(__dirname, './.env');
dotenv.config({
  path: config.envfile,
});

config.paths = {
  SOURCE: path.resolve(__dirname, '..'),
  BUILD: process.env.NODE_ENV !== 'production' ?
    path.resolve(__dirname, '../.build') :
    path.resolve(__dirname, '../dist'),
};

const entry = {
  style: config.paths.SOURCE + '/assets/scss/style.scss',
  vendors: config.paths.SOURCE + '/assets/js/vendors.js',
};
const output = process.env.NODE_ENV !== 'production' ? {
  path: config.paths.BUILD,
  filename: 'assets/js/[name].js',
  chunkFilename: 'assets/js/[name].chunk.js',
  publicPath: '/',
} : {
  path: config.paths.BUILD,
  filename: 'assets/js/[name].[hash].js',
  chunkFilename: 'assets/js/[name].chunk.[hash].js',
  publicPath: '/',
};
const modules = {
  rules: [
    {
      test: /\.(j|t)s(x)?$/,
      enforce: 'pre',
      exclude: /node_modules/,
      use: [
        {
          loader: 'babel-loader',
          options: {
            babelrc: false,
            extends: path.resolve(__dirname, '../.babelrc'),
          },
        },
      ],
    },
    {
      test: /\.(png|svg|jpg|gif)$/,
      use: [
        {
          'loader': 'file-loader',
          'options': {
            useRelativePath: true,
            name: '[name].[ext]',
            context: config.paths.SOURCE,
            publicPath: config.paths.BUILD + '/assets/img/',
          },
        },
      ],
    },
    {
      test: /\.(s)?css$/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            modules: true,
            camelCase: true,
            getLocalIdent: (context, localIdentName, localName) => {
              return generateScopedName(localName, context.resourcePath);
            },
            localIdentName: '[name]_[local]_[hash:base64:5]',
            sourceMap: true,
            importLoaders: 2,
          },
        },
        {
          loader: 'postcss-loader',
          options: {
            plugins: [require('autoprefixer')({
              browsers: [
                'last 2 versions',
                'ie >= 9',
                'android >= 4.4',
                'ios >= 7',
              ],
            })],
            sourceMap: true,
          },
        },
        {
          loader: 'sass-loader',
          options: {
            includePaths: [
              path.resolve(__dirname, '../node_modules'),
              path.resolve(__dirname, '../node_modules/foundation-sites/scss'),
            ],
            sourceMap: true,
          },
        },
      ],
    },
  ],
};
const resolve = {
  extensions: [
    '*', '.js', '.jsx', '.ts', '.tsx',
  ],
};
const plugins = [
  new BrowserSyncPlugin({
    // server: {
    //   baseDir: config.paths.BUILD,
    //   // middleware: [historyApiFallback()],
    //   index: 'index.html',
    // },
    // port: process.env.WEB_PORT,
    proxy: 'localhost:9000',
    browser: 'Google Chrome',
    open: false,
    cors: true,
    https: true,
    ui: false,
  }),
  new CleanWebpackPlugin(
      [
        config.paths.BUILD + '/**/*',
      ], {
        allowExternal: true,
      }
  ),
  new CopyWebpackPlugin([
    config.paths.SOURCE + '/**/*.php',
    config.paths.SOURCE + '/screenshot.*',
    config.paths.SOURCE + '/assets/fonts/**/*',
  ], {
    // context: 'src/',
  }
  ),
  new Dotenv({
    path: config.envfile,
  }),
  new MiniCssExtractPlugin({
    filename: 'style.css',
    chunkFilename: process.env.NODE_ENV !== 'production' ?
      'assets/css/[id].css' : 'assets/css/[id].[hash].css',
  }),
  new webpack.NoEmitOnErrorsPlugin(),
];
const optimization = {
  splitChunks: {
    chunks: 'async',
    minSize: 30000,
    maxSize: 0,
    minChunks: 1,
    maxAsyncRequests: 5,
    maxInitialRequests: 3,
    automaticNameDelimiter: '~',
    name: true,
    cacheGroups: {
      vendors: {
        test: /[\\/]node_modules[\\/]/,
        priority: -10,
      },
      default: {
        minChunks: 2,
        priority: -20,
        reuseExistingChunk: true,
      },
    },
  },
  minimizer: process.env.NODE_ENV !== 'production' ? [] : [
    new UglifyJsPlugin({
      cache: true,
      parallel: true,
      sourceMap: true, // set to true if you want JS source maps
    }),
    new OptimizeCSSAssetsPlugin({}),
  ],
};
const watchOptions = {
  ignored: [
    'node_modules',
  ],
};
const devServer = {
  contentBase: config.paths.BUILD,
  compress: true,
  port: process.env.WEB_PORT,
  historyApiFallback: true,
  open: true,
  hot: true,
};

config.webpack = {
  mode: process.env.NODE_ENV,
  entry: entry,
  output: output,
  module: modules,
  resolve: resolve,
  plugins: plugins,
  optimization: optimization,
  // devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  devtool: 'eval-source-map',
  target: 'node',
  stats: {
    warnings: false,
  },
  cache: true,
};

export default config.webpack;
