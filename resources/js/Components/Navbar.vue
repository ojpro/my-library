<template>

  <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
      <router-link :to="{name:'home'}" class="flex items-center">

        <svg class="w-7 h-7 dark:text-white mr-2" fill="none" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
          <path
              d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9"
              stroke-linecap="round"
              stroke-linejoin="round"/>
        </svg>

        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">My Library</span>
      </router-link>

      <div class="flex md:order-2 ml-auto">
        <!--  Theme Switcher    -->
        <div class="relative">
          <label class="flex relative items-center cursor-pointer mt-2 mr-4">
            <input v-model="isDark" class="sr-only peer" type="checkbox" value="">
            <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
              <span class="p-0.5">☀🌙</span>
            </div>
          </label>
        </div>
        <!--  Theme Switcher  - END   -->

        <router-link
            :to="{name:'upload'}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
          Upload a Book
        </router-link>
        <button aria-controls="navbar-cta" aria-expanded="false"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                data-collapse-toggle="navbar-cta" type="button">
          <span class="sr-only">Open main menu</span>
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  fill-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div id="navbar-cta" class="items-center justify-start hidden w-full md:flex md:w-auto md:order-1 ml-8">
        <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <router-link :to="{name:'home'}"
                         aria-current="page"
                         class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white">
              Home
            </router-link>
          </li>
          <li>
            <router-link
                :to="{name:'books'}"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              Books
            </router-link>
          </li>
          <li>
            <router-link
                :to="{name:'search'}"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              Search
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      theme: 'light',
      isDark: false
    }
  },
  created() {
    this.getCurrentThemeFromLocalStorage()
  },
  watch: {
    theme: function (theme) {
      this.isDark = theme === 'dark'
      this.toggleTheme(theme)
    },
    isDark: function (isDark) {
      let theme = isDark ? 'dark' : 'light'
      this.setThemeInLocalStorage(theme)
    }
  },
  methods: {
    getCurrentThemeFromLocalStorage: function () {
      let theme = JSON.parse(localStorage.getItem('theme'))
      if (theme) {
        // set the theme for the site
        this.theme = theme
      } else {
        // store a theme in the localstorage
        this.setThemeInLocalStorage('dark')
      }
      return theme
    },
    setThemeInLocalStorage: function (value) {
      let theme = JSON.stringify(value)
      // store in localstorage
      localStorage.setItem('theme', theme);
      // Toggle the class
      this.toggleTheme(value);
    },
    toggleTheme: function (theme) {
      if (theme === 'dark') {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
      this.theme = theme
    }
  }
}
</script>