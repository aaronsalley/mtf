import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import ArticleGridComponent from '.';

export default {
  title: 'Jamstack/Components/Organisms/Article Grid',
  component: ArticleGridComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof ArticleGridComponent>;

const Template: ComponentStory<typeof ArticleGridComponent> = (args: any) => (
  <ArticleGridComponent {...args} />
);

export const ArticleGrid = Template.bind({});
ArticleGrid.args = { posts: [], maxColumns: 4 };
