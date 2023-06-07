<template>
    <Head title="Welcome" />

    <div class="container">
        <header class="h-24">
            <div
                v-if="canLogin"
                class="sm:fixed sm:top-0 sm:right-0 p-6 text-right"
            >
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Dashboard</Link
                >

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Log in</Link
                    >

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Register</Link
                    >
                </template>
            </div>
        </header>

        <MainLayout>
            <form>
                <label for="search">
                    <input
                        v-model="search"
                        id="search"
                        name="search"
                        type="search"
                        class="h-[150px] focus:outline-black bg-transparent w-full text-8xl"
                        placeholder="Start typing..."
                        autofocus
                    />
                </label>
            </form>

            <section class="mt-12 grid grid-cols-6 gap-x-4 gap-y-8">
                <div class="col-span-6 md:col-span-3 lg:col-span-2">
                    <div
                        class="border-b border-gray-500 flex justify-between items-center"
                    >
                        <span class="text-sm"> Artist </span>
                        <span class="text-sm"> Genre </span>
                    </div>
                    <ul v-auto-animate class="mt-6 flex flex-col space-y-2.5">
                        <li
                            v-for="artist in results.artists"
                            :key="artist.artistId"
                            class="flex justify-between"
                        >
                            <!-- <RouterLink
                                :to="{
                                    name: 'artist',
                                    params: { id: artist.artistId }
                                }"
                                class="text-2xl leading-none hover:text-red-500"
                            > -->
                            <a href="#">
                                {{ artist.artistName }}
                            </a>
                            <!-- </RouterLink> -->
                            <span class="text-sm text-gray-500">
                                {{ artist.primaryGenreName }}
                            </span>
                        </li>
                    </ul>
                </div>
            </section>
        </MainLayout>

        <footer class="h-24"></footer>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { debounce } from 'lodash'
import { Head, Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

defineProps({
    canLogin: {
        type: Boolean
    },
    canRegister: {
        type: Boolean
    },
    results: {
        type: Array
    }
})

const search = ref('')

watch(
    search,
    debounce(function (value) {
        router.get('/home', { search: value })
    }, 300)
)
</script>
