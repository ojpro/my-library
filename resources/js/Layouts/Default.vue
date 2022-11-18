<template>
  <div>
    <header>
      <Navbar/>
      <HeroSection/>
    </header>
  </div>
</template>

<script>

import Navbar from "@/Components/Navbar.vue";
import HeroSection from "@/Sections/Hero.vue";

export default {
  name: "Default",
  components: {Navbar, HeroSection}
}
</script>

<style scoped>

</style>