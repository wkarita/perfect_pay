<template>
  <div class="col">
    <div class="card">
      <table class="table">
        <thead>
          <slot name="header"></slot>
        </thead>
        <tbody>
          <slot></slot>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardComponent",
};
</script>
