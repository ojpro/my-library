<template>
  <div>
    <input id="category"
           v-model="inputValue"
           autocomplete="off"
           class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           minlength="3"
           placeholder="Select Category" required
           type="search"
           @keyup="typing">
    <ul v-show="options"
        class="bg-white flex flex-col max-h-32 rounded-b-md overflow-hidden overflow-y-auto">
      <li v-for="option in options" :key="option.id"
          class="p-2 cursor-pointer border-b border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-700/95"
          @click="selectedOption(option)">
        {{ option.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "SearchFieldWithResults",
  props: ['options', 'selectOption'],
  data() {
    return {
      inputValue: this.selectOption.name || ''
    }
  },
  watch: {
    selectOption: function (category) {
      this.inputValue = category.name
    }
  },
  methods: {
    typing: function () {
      this.$emit('category', this.inputValue)
    },
    selectedOption: function (option) {
      this.inputValue = option.value || option.name
      this.$emit("selected", option)
    }
  }
}
</script>

<style scoped>

</style>