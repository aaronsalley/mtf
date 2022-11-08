import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import EventRowComponent from '.';

export default {
  title: 'Jamstack/Components/Molecules/Event Row',
  component: EventRowComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof EventRowComponent>;

const Template: ComponentStory<typeof EventRowComponent> = (args: any) => (
  <EventRowComponent {...args} />
);

export const EventRow = Template.bind({});
EventRow.args = {
  title: 'The Headline',
  datetimeEnd: '12.01.2021',
  excerpt: 'This is the teaser copy.',
  link: { text: 'Read more', url: '#' },
};
