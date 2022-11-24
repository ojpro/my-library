<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 container mx-auto mt-4">
    <BookCard v-for="book in this.books" :key="book.id" :description="book.description" :title="book.title"></BookCard>
  </div>
</template>

<script>
import BookCard from "@/Components/BookCard.vue";
import axios from "axios";

export default {
  name: "Books",
  components: {BookCard},
  data() {
    return {
      books: []
    }
  },
  methods: {
    fetchBooks() {
      axios.get("/api/books")
          .then(({data}) => {
            this.books = data
          })
          .catch((error) => {
            console.log(error)
          })
    }
  },
  mounted() {
    this.fetchBooks();
  }
}
</script>

<style scoped>

</style>