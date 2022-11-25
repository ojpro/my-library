<template>
  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        What are you planning to read today ?</h1>
      <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
        Just start typing and we will help you find your target books and suggest to new categories that will helps you
        grow.
      </p>
      <!--  Search Form    -->
      <div class="w-full sm:w-5/6 lg:w-4/6 mx-auto my-8">
        <SearchField></SearchField>
      </div>
    </div>
  </section>
</template>

<script>
import SearchField from "@/Components/Form/SearchField.vue";

export default {
  name: "Hero",
  components: {SearchField}
}
</script>

<style scoped>

</style>