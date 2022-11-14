import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import MessageComponent from '.';

export default {
  title: 'Jamstack/Components/Molecules/Message',
  component: MessageComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof MessageComponent>;

const Template: ComponentStory<typeof MessageComponent> = (args: any) => (
  <MessageComponent {...args} />
);

export const Message = Template.bind({});
Message.args = {
  text: '',
  link: undefined,
};
