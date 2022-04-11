import axios from 'axios';

export default () => {
  //let currentUser = JSON.parse(window.localStorage.currentUser);
  return axios.create({
    baseURL: 'http://localhost/api',
    withCredentials: false,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      //Authorization: currentUser && currenUser.token
    }
  });
} 