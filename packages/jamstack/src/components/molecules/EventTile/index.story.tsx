import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import EventTileComponent from '.';

export default {
  title: 'Jamstack/Components/Molecules/Event Tile',
  component: EventTileComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof EventTileComponent>;

const Template: ComponentStory<typeof EventTileComponent> = (args: any) => (
  <EventTileComponent {...args} />
);

export const EventTile = Template.bind({});
EventTile.args = {
  title: 'Event Title',
  datetimeStart: '12.01.2021',
  datetimeEnd: '12.01.2021',
  excerpt: 'This event summary.',
  link: { text: 'Details', url: '#' },
};
