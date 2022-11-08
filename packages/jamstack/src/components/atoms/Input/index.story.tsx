import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import InputComponent from '.';

export default {
  title: 'Jamstack/Components/Atoms/Input',
  component: InputComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof InputComponent>;

const Template: ComponentStory<typeof InputComponent> = (args: any) => (
  <InputComponent {...args} />
);

export const Input = Template.bind({});
Input.args = {
  name: 'test',
  label: 'Label',
  value: '',
  type: 'text',
  hidden: false,
};
