import { defineStore } from "pinia";
import apiLaravel from "../services/apiLaravel.js";

export const useClientListStore = defineStore("UserClientStore", {
  actions: {
    fetchClients() {
      return new Promise((resolve, reject) => {
        apiLaravel
          .get("/clients")
          .then((response) => {
            resolve(response.data.data);
          })
          .catch((error) => reject(error));
      });
    },
    searchCpfCnpj(cpfCnpj) {
      return new Promise((resolve, reject) => {
        apiLaravel
          .get("/client/" + cpfCnpj)
          .then((response) => {
            resolve(response.data.data);
          })
          .catch((error) => reject(error));
      });
    },
    saveRegister(register) {
      const form = {
        name: register.name,
        cpfCnpj: register.cpfCnpj,
        addressNumber: register.addressNumber,
        postalCode: register.postalCode,
      };

      return new Promise((resolve, reject) => {
        apiLaravel
          .post("/client/", form)
          .then((response) => {
            resolve(response.data.data);
          })
          .catch((error) => {
            reject(error);
          });
      });
    },
  },
});
