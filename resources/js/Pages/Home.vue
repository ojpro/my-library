<template>
  <DefaultLayout>
    <HeroSection></HeroSection>
  </DefaultLayout>
</template>

<script>
import DefaultLayout from "@/Layouts/Default.vue";
import HeroSection from "@/Sections/Hero.vue";

export default {
  name: "Home",
  components: {DefaultLayout, HeroSection}
}
</script>

<style scoped>

</style>