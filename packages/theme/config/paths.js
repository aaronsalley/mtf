'use strict';

const fs = require('fs');
const path = require('path');

const appDirectory = fs.realpathSync(process.cwd());
const HMR = require('./hmr.js');
const hmr = HMR.getClient();

const moduleFileExtensions = [
  'web.mjs',
  'mjs',
  'web.js',
  'js',
  'web.ts',
  'ts',
  'web.tsx',
  'tsx',
  'json',
  'web.jsx',
  'jsx',
];

const resolveApp = (relativePath) => path.resolve(appDirectory, relativePath);

module.exports = {
  dotenv: resolveApp('.env'),
  appPath: resolveApp('.'),
  appBuild: resolveApp('build'),
  appTemp: resolveApp('.build'),
  appFiles: {
    'style': process.env.NODE_ENV === 'development' ?
      [hmr, resolveApp('src/assets/scss/style.scss')] :
      resolveApp('src/assets/scss/style.scss'),
    'print': process.env.NODE_ENV === 'development' ?
      [hmr, resolveApp('src/assets/scss/print.scss')] :
      resolveApp('src/assets/scss/print.scss'),
    'vendors': process.env.NODE_ENV === 'development' ?
      [hmr, resolveApp('src/assets/js/vendors.js')] :
      resolveApp('src/assets/js/vendors.js'),
    // 'wordpress': [
    // resolveApp('src/assets/js/color-calculations.js'),
    // resolveApp('src/assets/js/customize-controls.js'),
    // resolveApp('src/assets/js/customize-preview.js'),
    // resolveApp('src/assets/js/customize.js'),
    // resolveApp('src/assets/js/editor-script-block.js'),
    // resolveApp('src/assets/js/index.js'),
    // resolveApp('src/assets/js/skip-link-focus-fix.js'),
    // ],
    // 'react': resolveApp('src/index.jsx'),
  },
  appPackageJson: resolveApp('package.json'),
  appSrc: resolveApp('src'),
  appTsConfig: resolveApp('tsconfig.json'),
  appJsConfig: resolveApp('jsconfig.json'),
  appNodeModules: resolveApp('node_modules'),
};

module.exports.moduleFileExtensions = moduleFileExtensions;