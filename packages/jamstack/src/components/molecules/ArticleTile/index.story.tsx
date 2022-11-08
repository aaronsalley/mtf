import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import ArticleTileComponent from '.';

export default {
  title: 'Jamstack/Components/Molecules/Article Tile',
  component: ArticleTileComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof ArticleTileComponent>;

const Template: ComponentStory<typeof ArticleTileComponent> = (args: any) => (
  <ArticleTileComponent {...args} />
);

export const ArticleTile = Template.bind({});
ArticleTile.args = {
  title: 'The Headline',
  date: '12.01.2021',
  excerpt: 'This is the teaser copy.',
  link: { text: 'Read more', url: '#' },
};
