import { ReactNode } from 'react';

export const locale = (date: string) => {
  const theDate = new Date(Date.parse(date));

  return theDate.toLocaleDateString();
};

export const dates = (
  startDate?: string,
  endDate?: string,
  startTime?: string,
  endTime?: string
): ReactNode => {
  if (!startDate) return null;

  return startDate === endDate
    ? formattedDate(startDate)
    : `${formattedDate(startDate)} – ${formattedDate(endDate)}`;
};

export const formattedDate = (
  date: string | undefined,
  delimiter = '.'
): string => {
  if (typeof date === 'undefined') return '';

  const theDate = new Date(Date.parse(date));
  const options = {
    weekday: undefined,
    year: 'numeric' as any,
    month: '2-digit' as any,
    day: '2-digit' as any,
    hour: undefined,
    minute: undefined,
    second: undefined,
    fractionalSecondDigits: undefined,
    hour12: true,
    timeZone: undefined,
  };
  const formatter = Intl.DateTimeFormat(undefined, options);

  const delimitedDate = formatter
    .formatToParts(theDate)
    .map(({ type, value }) => {
      switch (type) {
        case 'literal':
          return delimiter;
        default:
          return value;
      }
    })
    .join('');

  return delimitedDate;
};

export const formattedTime = (date: string | undefined): string => {
  if (typeof date === 'undefined') return '';

  const theDate = new Date(Date.parse(date));
  const options = {
    weekday: undefined,
    year: undefined,
    month: undefined,
    day: undefined,
    hour: '2-digit' as any,
    minute: '2-digit' as any,
    second: undefined,
    fractionalSecondDigits: undefined,
    hour12: true,
    timeZone: undefined,
  };
  const formatter = Intl.DateTimeFormat(undefined, options);

  return formatter.format(theDate);
};
