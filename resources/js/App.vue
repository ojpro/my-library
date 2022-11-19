<template>
  <DefaultLayout></DefaultLayout>
  <router-view></router-view>
</template>

<script>
import DefaultLayout from "@/Layouts/Default.vue";

export default {
  name: "App",
  components: {DefaultLayout}

}
</script>