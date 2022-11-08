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
  title: 'Example page title',
  excerpt: 'Event summary.',
  location: 'Location',
  datetimeStart: undefined,
  datetimeEnd: '12.01.2021',
  link: { text: 'Details' },
};
