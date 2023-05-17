import { defineStore } from "pinia";
import apiLaravel from "../services/apiLaravel.js";
import moment from "moment";

export const useAbillingListStore = defineStore("UserAbillingStore", {
  actions: {
    saveAbilling(register, id) {
      let form = "";
      if (register.billingType == "CREDIT_CARD") {
        form = {
          customer: id,
          billingType: register.billingType,
          dueDate: moment(register.dueDate, "DD/MM/YYYY").format("YYYY-MM-DD"),
          value: register.value.replace(",", "."),
          postalService: register.postalService,
          cardName: register.cardName,
          cardCpfCnpj: register.cardCpfCnpj,
          cardEmail: register.cardEmail,
          cardPhone: register.cardPhone,
          cardPostalCode: register.cardPostalCode,
          cardAddressNumber: register.cardAddressNumber,
          holderName: register.holderName,
          number: register.number,
          expiryDate: register.expiryDate,
          ccv: register.ccv,
        };
      } else {
        form = {
          customer: id,
          billingType: register.billingType,
          dueDate: moment(register.dueDate, "DD/MM/YYYY").format("YYYY-MM-DD"),
          value: register.value.replace(",", "."),
        };
      }

      return new Promise((resolve, reject) => {
        apiLaravel
          .post("/billing/", form)
          .then((response) => {
            resolve(response.data.data);
          })
          .catch((error) => reject(error));
      });
    },
  },
});
