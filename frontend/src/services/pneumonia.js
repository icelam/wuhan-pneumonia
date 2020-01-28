import axios from 'axios';

const getLiveData = () => axios.get(`${process.env.VUE_APP_PNEUMONIA_LIVE_DATA}?t=${Date.now()}`);

const getHistoricalData = () => axios.get(`${process.env.VUE_APP_PNEUMONIA_HISTORICAL_DATA}?t=${Date.now()}`);

export default { getLiveData, getHistoricalData };
