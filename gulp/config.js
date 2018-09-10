'use strict';

import CleanWebpackPlugin from 'clean-webpack-plugin';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import NpmInstallPlugin from 'npm-install-webpack-plugin';
import path from 'path';

const config = {}

config.paths = {
  SOURCE: path.resolve(__dirname, '../src'),
  BUILD: path.resolve(__dirname, '../dist'),
  DOCS: path.resolve(__dirname, '../docs'),
}

const entry = {
  react: config.paths.SOURCE + '/index.js',
  vendors: config.paths.SOURCE + '/assets/js/vendors.js',
}
const output = {
  filename: '[name].js',
  chunkFilename: '[name].js',
}
const modules = {
  rules: [
    {
      test: /\.(s)?css$/,
      use: [
        process.env.NODE_ENV !== 'production' ? 'style-loader' : 'MiniCssExtractPlugin.loader',
        'css-loader',
        {
          loader: 'postcss-loader',
          'options': {
            plugins: require('autoprefixer')
          }
        },
        'sass-loader',
      ],
    },
    {
      test: /\.ts$/,
      use: 'ts-loader',
    },
    {
      test: /\.js?(x)$/,
      enforce: 'pre',
      exclude: /node_modules/,
      use: [
        {
          loader: 'babel-loader',
        },
        // {
        //   loader: 'jshint-loader',
        // },
      ],
    },
  ]
}
const plugins = [
  new CleanWebpackPlugin(
    [
      config.paths.BUILD,
      config.paths.DOCS,
    ], {
      root: path.resolve(__dirname, '../'),
    }
  ),
  new HtmlWebpackPlugin(),
  // new NpmInstallPlugin(),
  new MiniCssExtractPlugin({
    filename: process.env.NODE_ENV !== 'production' ? '[name].css' : '[name].[hash].css'
  }),
]
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
}
const watchOptions = {
  ignored: ['node_modules'],
}
const devServer = {
  contentBase: config.paths.BUILD,
  // compress: true,
  // port: 9000,
  historyApiFallback: true,
}

config.webpack = {
  mode: process.env.NODE_ENV || 'development',
  entry: entry,
  output: output,
  module: modules,
  plugins: plugins,
  optimization: optimization,
  devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  devtool: 'eval-source-map',
}

export default config;
