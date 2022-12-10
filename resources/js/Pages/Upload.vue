<template>
  <div
      class="container mx-auto my-5 w-11/12 sm:w-5/6 md:w-4/6 lg:w-3/5 xl:w-2/6 p-4 rounded shadow-md dark:bg-gray-800">

    <h1 class="text-lg text-center dark:text-white">Upload New Book</h1>

    <hr class="my-2 h-px bg-gray-100 border-0 dark:bg-gray-700">

    <form class="p-2" enctype="multipart/form-data" method="post" @submit.prevent="publish">

      <!--   File Form   -->
      <div class="flex items-center justify-center w-full my-4">
        <label
            :class=" errors.file ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600'"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:hover:border-gray-500 dark:hover:bg-gray-600"
            for="dropzone-file">
          <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                    stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"></path>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                class="font-semibold">Click to upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PDF, EPUB or Mobi (MAX. 50Mb)</p>
          </div>
          <input id="dropzone-file" accept="application/pdf" class="hidden" type="file"
                 @change="catchSelectedFile($event)"/>
        </label>
      </div>
      <!--   TODO: improve the error messages   -->
      <p v-if="errors.file" class="mt-2 text-sm text-red-600 dark:text-red-500">
        {{ errors.file[0] }}
      </p>
      <!-- !  File Form   -->

      <!--    Book Title    -->
      <div class="my-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Book
          Title</label>
        <input id="title"
               v-model="form.title"
               :class=" errors.title ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600'"
               class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               minlength="3"
               placeholder="Book's Title"
               required type="text">
        <p v-if="errors.title" class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ errors.title[0] }}
        </p>
      </div>
      <!-- !   Book Title    -->

      <!--   Select Book Category   -->
      <SearchFieldWithResults
          :options="this.categories" @category="searchFor" @selected="selectCategory"
      />
      <!-- !   Select Book Category   -->

      <!--    Book Description    -->
      <div class="my-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="description">Book
          Description</label>
        <textarea id="description"
                  v-model="form.description"
                  :class=" errors.description ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600'"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                  placeholder="Write description about this book..." required
                  rows="4"></textarea>

        <p v-if="errors.description" class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ errors.description[0] }}
        </p>
      </div>
      <!-- !   Book Description    -->

      <!--    Publish Term & Policy     -->
      <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
          <input id="terms"
                 v-model="form.accept_term"
                 class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                 required
                 type="checkbox">
        </div>
        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="terms">I agree with the <a
            class="text-blue-600 hover:underline dark:text-blue-500" href="#">terms and conditions</a></label>
      </div>
      <!-- !   Publish Term & Policy     -->

      <!--    Book Submit    -->
      <div class="mt-6">
        <button
            :disabled=!form.accept_term
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 dark:disabled:bg-blue-400 disabled:bg-blue-400 disabled:cursor-not-allowed"
            type="submit">
          Publish This Book
        </button>
      </div>
      <!-- !   Book Submit    -->


    </form>
  </div>
</template>

<script>
import SearchFieldWithResults from "@/Components/Form/SearchFieldWithResults.vue";
import axios from "axios";

export default {
  name: "Upload",
  components: {
    SearchFieldWithResults
  },
  data() {
    return {
      categories: {},
      form: {
        file: null,
        title: "",
        category_id: null,
        description: "",
        accept_term: false
      },
      errors: {
        file: null,
        title: null,
        description: null
      }
    }
  },
  methods: {
    // catch typing event on the category field
    searchFor: async function (value) {
      await axios.get(`/api/category?query=${value}`)
          .then(({data}) => {
            this.categories = data
            // add option to create new category
            if (!this.categories.includes(value) || value !== '') {
              let new_option = {
                id: 0,
                value: value,
                name: `Create ${value} Category`
              }
              this.categories.unshift(new_option)
            }
          })
          .catch(error => {
            console.log(error)
          })
    },
    // handel category selection
    selectCategory: function (category) {
      if (category.id === 0) {
        this.createCategory(category.value)
      }
      this.categories = {}
      this.form.category_id = category.id
    },
    // create new category
    createCategory: async function (categoryName) {
      await axios.post("/api/category", {
        name: categoryName
      }).then(({data}) => {
        this.form.category_id = data.category.id
      }).catch(error => {
        console.log(error)
      })
    },
    catchSelectedFile: function (event) {
      // store the selected file object
      let file = event.target.files || event.dataTransfer.files;
      // check if there is a file
      if (file.length) {
        this.form.file = file[0];
      }
      // change file field border
      event.target.parentElement.classList.add('border-blue-400', 'dark:border-blue-400', 'hover:border-blue-300', 'dark:hover:border-blue-300')
    },
    publish: async function () {
      // declare form data to send
      let formData = new FormData();
      formData.append("file", this.form.file)
      formData.append("title", this.form.title)
      formData.append("category_id", this.form.category_id)
      formData.append("description", this.form.description)
      // sent request to upload the book
      // TODO: use global configured axios
      await axios.post("api/books/", formData)
          // redirect to the home page if there is no errors
          .then(_ => this.$router.push("/"))
          // catch response errors
          .catch(({response}) => {
            // Stored errors on one variable to display them on the form
            this.errors = response.data.errors
          })

    }
  }
}
</script>

<style scoped>

</style>