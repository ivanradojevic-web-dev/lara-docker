<template>
    <Head title="Home" />

    <div class="container">
        <HeaderLayout :canLogin="canLogin" :canRegister="canRegister" />

        <MainLayout>
            <section>
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
                            autocomplete="off"
                        />
                    </label>
                </form>
            </section>

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

                <SearchList title="Song" label="Artist">
                    <li
                        v-for="song in results.songs"
                        class="flex justify-between space-x-1"
                    >
                        <div class="flex space-x-2.5">
                            <img
                                :src="song.artworkUrl60"
                                class="rounded-full w-6 h-6"
                            />
                            <span class="text-2xl leading-none">{{
                                song.collectionName
                            }}</span>
                        </div>
                        <div class="flex-none">
                            <span class="text-sm text-gray-500">
                                {{ song.artistName }}
                            </span>
                        </div>
                    </li>
                </SearchList>

                <SearchList title="Album" label="Artist">
                    <li
                        v-for="album in results.albums"
                        class="flex justify-between space-x-1"
                    >
                        <div class="flex space-x-2.5">
                            <img
                                :src="album.artworkUrl60"
                                class="rounded-full w-6 h-6"
                            />
                            <span class="text-2xl leading-none">{{
                                album.collectionName
                            }}</span>
                        </div>
                        <div class="flex-none">
                            <span class="text-sm text-gray-500">
                                {{ album.artistName }}
                            </span>
                        </div>
                    </li>
                </SearchList>

                <SearchList title="Video" label="Name">
                    <li
                        v-for="video in results.videos"
                        class="flex justify-between"
                    >
                        <img :src="video.artworkUrl60" />
                        <span class="text-xs text-gray-500">
                            {{ video.artistName }} - {{ video.trackName }}
                        </span>
                    </li>
                </SearchList>
            </section>
        </MainLayout>

        <footer class="h-24"></footer>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { debounce } from 'lodash'
import { Head, Link, router } from '@inertiajs/vue3'
import HeaderLayout from '@/Layouts/HeaderLayout.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import SearchList from '@/Components/SearchList.vue'

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
