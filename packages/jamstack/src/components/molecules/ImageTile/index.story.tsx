import React from 'react';
import { ComponentStory, ComponentMeta } from '@storybook/react';
import '../../templates/Layout/globals.scss';

import ImageTileComponent from '.';

export default {
  title: 'Jamstack/Components/Molecules/Image Tile',
  component: ImageTileComponent,
  decorators: [],
  parameters: {
    // More on Story layout: https://storybook.js.org/docs/react/configure/story-layout
    layout: 'centered',
  },
} as ComponentMeta<typeof ImageTileComponent>;

const Template: ComponentStory<typeof ImageTileComponent> = (args: any) => (
  <ImageTileComponent {...args} />
);

export const ImageTile = Template.bind({});
ImageTile.args = {
  src: '',
  alt: '',
  minHeight: 181,
  maxHeight: 384,
};
