export const zeroPad = (n, x) => {
  if (typeof x !== 'number') {
    return n;
  }

  return (n < 10 ? `${'0'.repeat(x)}${n}` : `${n}`);
};

// Convert '20/01/2020' to '1 月 20 日'
export const formatDateWithSlash = (date) => {
  const datePart = date.split('/');
  return datePart.length > 1 ? `${parseInt(datePart[1], 10)} 月 ${parseInt(datePart[0], 10)} 日` : date;
};

// Convert Date.now() to date string
export const formatDate = (dateToFormat) => {
  const d = new Date(dateToFormat);

  if (Number.isNaN(d.getTime())) {
    return '';
  }

  const year = d.getFullYear();
  const month = d.getMonth() + 1;
  const date = d.getDate();
  const hour = d.getHours();
  const minute = d.getMinutes();
  const timeRange = hour < 12 ? '上午' : '下午';
  const displayHour = hour === 0
    ? 12
    : hour > 12
      ? hour - 12
      : hour;

  return `${year} 年 ${month} 月 ${date} 日 ${timeRange} ${zeroPad(displayHour, 1)} 時 ${zeroPad(minute, 1)} 分`;
};

// Supported only by IE 11+
export const localeDate = (dateToFormat) => {
  const d = new Date(dateToFormat);
  const formattedDate = d.toLocaleString(
    'zh-Hans-HK',
    {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    }
  );

  return `${formattedDate}`;
};

