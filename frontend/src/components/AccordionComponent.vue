<template>
  <h2 class="accordion-header" :id="'header_' + databstarget">
    <button
      class="accordion-button collapsed"
      type="button"
      data-bs-toggle="collapse"
      :data-bs-target="databstarget"
      aria-expanded="false"
      :aria-controls="databstargetId"
    >
      <strong>Título: {{ name }}</strong>
    </button>
  </h2>
  <div
    :id="databstargetId"
    class="accordion-collapse collapse"
    :aria-labelledby="'header_' + databstarget"
    data-bs-parent="#accordion"
  >
    <div class="accordion-body">
      <p><strong>Descrição: </strong>{{ description }}</p>
      <hr />
      <p v-if="html_url">
        <a :href="html_url" class="link-success pe-auto" target="_blank">
          Ver Repositório</a
        >
      </p>
      <p v-else>Link não registrado!!!</p>
      <hr />
    </div>
  </div>
</template>

<script>
export default {
  name: "AccordionComponent",
  props: ["name", "description", "html_url", "databstarget", "databstargetId"],
};
</script>
