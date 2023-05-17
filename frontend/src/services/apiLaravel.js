import axios from "axios";

const apiLaravel = axios.create({
  baseURL: "http://api.localhost:9090/api",
});

export default apiLaravel;
