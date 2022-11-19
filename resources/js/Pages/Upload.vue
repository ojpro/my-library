<template>
  <DefaultLayout>
    <div
        class="container mx-auto my-5 w-11/12 sm:w-5/6 md:w-4/6 lg:w-3/5 xl:w-2/6 p-4 rounded shadow-md dark:bg-gray-800">

      <h1 class="text-lg text-center dark:text-white">Upload New Book</h1>

      <hr class="my-2 h-px bg-gray-100 border-0 dark:bg-gray-700">

      <form class="p-2">

        <!--   File Form   -->
        <div class="flex items-center justify-center w-full my-4">
          <label
              class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
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
              <p class="text-xs text-gray-500 dark:text-gray-400">PDF, ePub or Docx (MAX. 50Mb)</p>
            </div>
            <input id="dropzone-file" accept="application/pdf" class="hidden" type="file"/>
          </label>
        </div>
        <!-- !  File Form   -->

        <!--    Book Title    -->
        <div class="my-6">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Book
            Title</label>
          <input id="title"
                 class="bg-gray-50 border border-gray-500 text-gray-900 dark:text-gray-400 placeholder-gray-700 dark:placeholder-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-500"
                 placeholder="Book's Title"
                 type="text">
          <p class="mt-2 text-sm text-green-600 dark:text-green-500"><span class="font-medium">Well done!</span> Some
            success message.</p>
        </div>
        <!-- !   Book Title    -->

        <!--    Book Description    -->
        <div class="my-6">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="description">Book
            Description</label>
          <textarea id="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write description about this book..."
                    rows="4"></textarea>
        </div>
        <!-- !   Book Description    -->

        <!--    Publish Term & Policy     -->
        <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
            <input id="terms"
                   class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                   required
                   type="checkbox"
                   value="">
          </div>
          <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="terms">I agree with the <a
              class="text-blue-600 hover:underline dark:text-blue-500" href="#">terms and conditions</a></label>
        </div>
        <!-- !   Publish Term & Policy     -->

        <!--    Book Submit    -->
        <div class="mt-6">
          <button
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              type="button">
            Publish This Book
          </button>
        </div>
        <!-- !   Book Submit    -->


      </form>
    </div>
  </DefaultLayout>
</template>

<script>
import DefaultLayout from "../Layouts/Default.vue";

export default {
  name: "Upload",
  components: {DefaultLayout}
}
</script>

<style scoped>

</style>