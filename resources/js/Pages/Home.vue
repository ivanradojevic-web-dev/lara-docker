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
                <SearchList title="Artist" label="Genre">
                    <li
                        v-for="artist in results.artists"
                        :key="artist.artistId"
                        class="flex justify-between"
                    >
                        <Link
                            href="#"
                            class="text-2xl leading-none hover:text-red-500"
                        >
                            {{ artist.artistName }}
                        </Link>
                        <span class="text-sm text-gray-500">
                            {{ artist.primaryGenreName }}
                        </span>
                    </li>
                </SearchList>

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
