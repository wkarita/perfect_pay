import { defineStore } from "pinia";
import apiLaravel from "../services/apiLaravel.js";

export const useRepositoryListStore = defineStore("RepositoryListStore", {
  state: () => ({
    profiles: [],
    userSelected: "",
  }),

  actions: {
    fetchRepositories(user) {
      return new Promise((resolve, reject) => {
        apiGitlab
          .get("/" + user + "/repos")
          .then((res) => {
            const repositories = res.data;
            resolve(repositories);
          })
          .catch((error) => reject(error));
      });
    },

    saveRepositories(user) {
      return new Promise((resolve, reject) => {
        const params = {
          login: user,
        };
        apiLaravel
          .post("/salvar-local/", params)
          .then((res) => {
            const repositories = res.data;
            resolve(repositories);
          })
          .catch((error) => reject(error));
      });
    },
  },
});
