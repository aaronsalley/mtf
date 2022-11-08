import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import PageTitleComponent from '.';

export default {
  title: 'Jamstack/Components/Atoms/Page Title',
  component: PageTitleComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof PageTitleComponent>;

const Template: ComponentStory<typeof PageTitleComponent> = (args: any) => (
  <PageTitleComponent {...args} />
);

export const PageTitle = Template.bind({});
PageTitle.args = {
  title: 'Example page title',
};
