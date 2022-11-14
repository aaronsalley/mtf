import Button from '../components/atoms/Button';

export interface EventItem {
  featuredImage: any;
  title: string;
  content: string;
  excerpt: string;
  categories: any;
  tags: any;
  locationName?: string;
  datetimeStart?: string;
  datetimeEnd: string;
  isAllDay: boolean;
  eventURL: string;
  ticketPrice: string;

  link: Button;
}
