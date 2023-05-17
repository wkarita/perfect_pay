<template>
  <div class="container">
    <form>
      <h2 class="text-center">Clientes cadastrados</h2>
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Buscar"
            aria-label="Search"
            v-model="search"
          />
        </div>
      </div>
      <hr />
      <br />
      <div class="text-end">
        <router-link
          to="/register"
          tag="button"
          class="btn btn-primary m-1 text-white"
        >
          Registrar Cliente
        </router-link>
      </div>
      <br />
      <div class="row">
        <table-component>
          <template #header>
            <tr class="d-flex">
              <th scope="col" class="col-5">Cliente</th>
              <th scope="col" class="col-4">Email</th>
              <th scope="col" class="col">Ação</th>
            </tr>
          </template>
          <template #default>
            <template v-for="item in itensFilter">
              <tr class="d-flex">
                <td class="col-5">{{ item.name }}</td>
                <td class="col-4">{{ item.email }}</td>
                <td class="col">
                  <button class="btn btn-warning text-white">
                    Área do cliente
                  </button>
                </td>
              </tr>
            </template>
          </template>
        </table-component>
      </div>
    </form>
  </div>
</template>

<script>
import TableComponent from "../components/TableComponent.vue";
import ModalComponent from "../components/ModalComponent.vue";
import { useClientListStore } from "../store/client";
import { ref, computed, onBeforeMount } from "vue";

export default {
  components: {
    TableComponent,
    ModalComponent,
  },
  name: "Home",
  setup() {
    let clients = ref([]);
    const search = ref("");
    const clientListStore = useClientListStore();
    let open = ref(true);

    onBeforeMount(() => {
      clientListStore.fetchClients().then((response) => {
        clients.value = response;
      });
    });

    const itensFilter = computed(() => {
      let filterClients = [];
      filterClients = clients.value.filter((client) => {
        return (
          client.name.toLowerCase().indexOf(search.value.toLowerCase()) > -1 ||
          client.cpfCnpj
            .toLowerCase()
            .indexOf(search.value.toLowerCase().replace(/[.-]/g, "")) > -1
        );
      });
      return filterClients;
    });

    return {
      clients,
      search,
      itensFilter,
      open,
    };
  },
};
</script>
