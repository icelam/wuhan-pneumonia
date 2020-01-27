const extractDxyStatistic = (str) => {
  const confirmed = str.match(/確診\s?(\d+)\s?例/m);
  const suspected = str.match(/疑似\s?(\d+)\s?例/m);
  const cured = str.match(/治癒\s?(\d+)\s?例/m);
  const dead = str.match(/死亡\s?(\d+)\s?例/m);

  return {
    confirmedCount: (confirmed && parseInt(confirmed[1], 10)) || 0,
    suspectedCount: (suspected && parseInt(suspected[1], 10)) || 0,
    curedCount: (cured && parseInt(cured[1], 10)) || 0,
    deadCount: (dead && parseInt(dead[1], 10)) || 0
  };
};

export default extractDxyStatistic;
