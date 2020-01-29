import axios from 'axios';

const getRelatedNews = () => axios.get(`${process.env.VUE_APP_NEWS_DATA}?t=${Date.now()}`);

export default { getRelatedNews };
