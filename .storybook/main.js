module.exports = {
  stories: [
    '../packages/jamstack/src/**/*.story.@(js|jsx|ts|tsx|mdx)',
    // '../packages/**/src/**/*.@(story|stories).@(js|jsx|ts|tsx|mdx)',
  ],
  addons: [
    '@storybook/addon-links',
    '@storybook/addon-essentials',
    '@storybook/addon-interactions',
    '@storybook/preset-scss',
    '@storybook/addon-a11y',
    '@storybook/addon-storysource',
  ],
  framework: '@storybook/react',
  core: {
    builder: '@storybook/builder-webpack5',
  },
};
