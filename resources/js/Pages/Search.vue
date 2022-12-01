<template>
  <div class="container mx-auto">
    <div class="w-full sm:w-4/5 md:w-2/3 lg:w-1/2 mx-auto p-4">
      <SearchField @searchFor="searchValue"></SearchField>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 container mx-auto mt-12">
      <BookCard v-for="book in this.books" :key="book.id" :description="book.description"
                :title="book.title"></BookCard>
    </div>
  </div>
</template>

<script>
import SearchField from "@/Components/Form/SearchField.vue";
import BookCard from "@/Components/BookCard.vue";

import axios from "axios";

export default {
  name: "Search",
  components: {SearchField, BookCard},
  data() {
    return {
      books: {}
    }
  },
  mounted() {
    // check if there is a query to search for
    let search = new URLSearchParams(window.location.search);
    let query = search.get('query') || ''
    // TODO: set search input value to the request query
    // searching..
    this.searchValue(query)
  },
  methods: {
    searchValue: async function (value = '') {
      // search for the received data
      await axios.get(`/api/books/?query=${value}`)
          // TODO
          .then(({data}) => {
            this.books = data
          })
          // catch response errors
          .catch(({response}) => {
            // TODO
            console.log(response)
          })
    }
  }
}
</script>

<style scoped>

</style>