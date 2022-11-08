import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../../templates/Layout/globals.scss';

import Form from '.';

export default {
  title: 'Jamstack/Components/Molecules/forms/Donor Lead',
  component: Form,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof Form>;

export const DonorLead = <Form />;
