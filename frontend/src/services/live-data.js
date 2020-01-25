import axios from 'axios';

const getLiveData = () => axios.get(`${process.env.VUE_APP_PNEUMONIA_DATA_SOURCE}?t=${Date.now()}`);

export default { getLiveData };
