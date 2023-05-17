<template>
  <div class="col">
    <div class="card">
      <div class="row g-0">
        <div class="col-md-3">
          <img :src="img" class="img-fluid rounded" :alt="alt" />
        </div>
        <div class="col-md-9">
          <div class="card-body">
            <h5 class="card-title text-uppercase">
              <strong>{{ user }}</strong>
            </h5>
          </div>
          <div class="text-end m-1">
            <p>
              <strong>{{ public_repos }}</strong>
              {{ public_repos > 1 ? "Repositórios" : "Repositório" }}
            </p>
          </div>
          <div class="text-center">
            <router-link
              :to="`/repository/${login}`"
              tag="button"
              class="btn btn-primary m-1"
              data-toggle="modal"
              data-target="#exampleModal"
            >
              Ver {{ public_repos > 1 ? "Repositórios" : "Repositório" }}
            </router-link>
          </div>
        </div>
        <div class="card-footer text-muted text-center">
          Usuário desde <strong>{{ registration_dt }}</strong>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardComponent",
  props: [
    "alt",
    "img",
    "user",
    "registration_dt",
    "public_repos",
    "login",
    "id",
    "link",
  ],
};
</script>
