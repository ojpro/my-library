<template>
  <div class="shadow-md dark:bg-gray-800/90 rounded-md m-1.5">
    <a :href="this.book.file_path" target="_blank">
      <div class="p-2">
        <img :src="this.book.book_thumbnail" class="rounded-md">
      </div>
      <div class="p-5 flex flex-col">
        <h5 class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
          {{ this.book.title }}
        </h5>
        <p class="font-normal text-gray-700 mb-3 dark:text-gray-400">
          {{ this.book.description }}
        </p>
        <router-link
            :to="{name:'edit',params:{id:this.book.id}}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-auto">
          Edit Book
          <svg class="-mr-1 ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  fill-rule="evenodd"></path>
          </svg>
        </router-link>
      </div>
    </a>
  </div>

</template>

<script>
export default {
  props: ['book'],
  name: "BookCard"
}
</script>

<style scoped>

</style>