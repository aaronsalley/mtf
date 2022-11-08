import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import ButtonComponent from '.';

export default {
  title: 'Jamstack/Components/Atoms/Button',
  component: ButtonComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof ButtonComponent>;

const Template: ComponentStory<typeof ButtonComponent> = (args: any) => (
  <ButtonComponent {...args} />
);

export const Button = Template.bind({});
Button.args = {
  text: 'Label',
};
