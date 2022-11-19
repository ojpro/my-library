<template>
  <div>
    <header>
      <Navbar/>
      <slot></slot>
    </header>
  </div>
</template>

<script>

import Navbar from "@/Components/Navbar.vue";

export default {
  name: "Default",
  components: {Navbar}
}
</script>

<style scoped>

</style>