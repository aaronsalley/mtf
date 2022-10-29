export const locale = (date: string) => {
  const theDate = new Date(Date.parse(date));

  return theDate.toLocaleDateString();
};

export const formattedDate = (date: string, delimiter = '.'): string => {
  const theDate = new Date(Date.parse(date));
  const options = {
    weekday: undefined,
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
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

export const formattedTime = (date: string): string => {
  const theDate = new Date(Date.parse(date));
  const options = {
    weekday: undefined,
    year: undefined,
    month: undefined,
    day: undefined,
    hour: '2-digit',
    minute: '2-digit',
    second: undefined,
    fractionalSecondDigits: undefined,
    hour12: true,
    timeZone: undefined,
  };
  const formatter = Intl.DateTimeFormat(undefined, options);

  return formatter.format(theDate);
};
