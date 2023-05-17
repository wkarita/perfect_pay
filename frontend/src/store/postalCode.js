import { defineStore } from "pinia";
import apiLaravel from "../services/apiLaravel.js";

export const usePostalCodeListStore = defineStore("UserPostalCodeStore", {
  actions: {
    searchPostalCode(postalCode) {
      return new Promise((resolve, reject) => {
        apiLaravel
          .get("/cep/" + postalCode)
          .then((response) => {
            resolve(response.data.data);
          })
          .catch((error) => reject(error));
      });
    },
  },
});
