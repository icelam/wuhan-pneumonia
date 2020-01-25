const generateTableData = (data) => {
  if (!data) {
    return [];
  }

  const tableData = data.map((p) => {
    const {
      confirmedCount,
      suspectedCount,
      // curedCount,
      deadCount,
      provinceShortName
    } = p;
    const summaryList = [];

    confirmedCount && summaryList.push(`確診 ${confirmedCount} 例`);
    suspectedCount && summaryList.push(`疑似 ${suspectedCount} 例`);
    deadCount && summaryList.push(`死亡 ${deadCount} 例`);
    // curedCount && summaryList.push(`治癒 ${curedCount} 例`);

    return [provinceShortName, summaryList.join('，')];
  });

  return tableData;
};

export default generateTableData;
