<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="bg-primary bg-cover bg-center bg-no-repeat h-screen bg-bgPic bgPic relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
      <!--button start-->
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Bienvenida</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="inline-block px-4 py-2 font-semibold text-gray-600 transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 inline-block px-4 py-2 font-semibold text-gray-600 transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >Register</Link
                >
            </template>
        </div>
        <!--button stop-->

        <div class="text-gray-200 flex flex-col md:flex-row px-6 md:px-20 pt-20 space-y-6 md:space-y-0 md:space-x-10 items-center">
          <div class="flex flex-col md:space-y-20 text-center md:text-left">
              <div class="flex flex-col md:flex-row items-center space-x-2 md:pb-36">
                <img class="w-20 mb-5 md:w-40 pt-10 md:pt-0" src="../../images/logo.png" alt="">
                <div>
                  <p class="text-4xl md:text-7xl">Dream Diary</p>
                  <p class="text-xl md:text-3xl mt-5">Share your dreams and get inspired!</p>
                </div>
              </div>              
          </div>
        </div>
    </div>
</template>

<style>
  .bgPic {
      background-image: url("../../images/background.jpg");
  }
</style>
