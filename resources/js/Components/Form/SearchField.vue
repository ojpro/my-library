<template>
  <form>
    <div class="flex">
      <label class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white" for="search-dropdown">Your
        Search</label>
      <button id="dropdown-button"
              class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
              data-dropdown-toggle="dropdown"
              type="button">All categories
        <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                fill-rule="evenodd"></path>
        </svg>
      </button>
      <div id="dropdown"
           class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700"
           data-popper-escaped="" data-popper-placement="top" data-popper-reference-hidden=""
           style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(897px, 5637px, 0px);">
        <ul aria-labelledby="dropdown-button" class="py-1 text-sm text-gray-700 dark:text-gray-200">
          <li>
            <button
                class="inline-flex w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                type="button">
              Self-Dev
            </button>
          </li>
          <li>
            <button
                class="inline-flex w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                type="button">
              Programming
            </button>
          </li>
          <li>
            <button
                class="inline-flex w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                type="button">
              Electronic
            </button>
          </li>
          <li>
            <button
                class="inline-flex w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                type="button">
              Study
            </button>
          </li>
        </ul>
      </div>
      <div class="relative w-full">
        <input id="search-dropdown"
               v-model="inputValue"
               class="block p-4 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
               placeholder="Search Programming, Self-Dev, Electronics..." required type="search" @keyup="typing">
        <button
            class="absolute top-0 right-0 p-4 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="submit"
            @click="search">
          <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"></path>
          </svg>
          <span class="sr-only">Search</span>
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "SearchField",
  data() {
    return {
      inputValue: ""
    }
  },
  methods: {
    search() {
      this.$router.push({name: 'search', query: {query: this.inputValue}})
    },
    typing() {
      // pass input data to the parent
      this.$emit("searchFor", this.inputValue)
    }
  }
}
</script>

<style scoped>

</style>