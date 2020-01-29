import axios from 'axios';

const getAeWaitingTime = () => axios.get(`${process.env.VUE_APP_AE_WAITING_DATA}?t=${Date.now()}`);

export default { getAeWaitingTime };
