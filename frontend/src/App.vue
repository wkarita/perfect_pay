<template>
  <div id="page-container">
    <div id="content-wrap">
      <navbar-component />
      <br />
      <router-view />
      <br />
    </div>
    <footer-component id="footer" />
  </div>
</template>

<script>
import FooterComponent from "./components/layouts/FooterComponent.vue";
import NavbarComponent from "./components/layouts/NavbarComponent.vue";
export default {
  components: { NavbarComponent, FooterComponent },
  name: "App",
};
</script>

<style scoped>
#page-container {
  position: relative;
  min-height: 100vh;
}

#content-wrap {
  padding-bottom: 74px;
}

#footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 74px;
}
</style>
