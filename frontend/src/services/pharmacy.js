import axios from 'axios';

const getPharmacyData = () => axios.get(`${process.env.VUE_APP_PHARMACY_DATA}?t=${Date.now()}`);

export default { getPharmacyData };
