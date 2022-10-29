import Button from '../../atoms/Button';

export interface EventItem {
  featuredImage: any;
  title: string;
  content: string;
  excerpt: string;
  categories: any;
  tags: any;
  location?: string;
  datetimeStart?: string;
  datetimeEnd: string;
  isAllDay: boolean;
  eventURL: string;
  ticketPrice: string;

  link: Button;
}
