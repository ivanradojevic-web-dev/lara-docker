<template>
    <section class="mt-12 grid grid-cols-6 gap-x-4 gap-y-8">
        <SearchList title="Artist" label="Genre">
            <li
                v-for="artist in results.artists"
                :key="artist.artistId"
                class="flex justify-between"
            >
                <Link href="#" class="text-2xl leading-none hover:text-red-500">
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
            <li v-for="video in results.videos" class="flex justify-between">
                <img :src="video.artworkUrl60" />
                <span class="text-xs text-gray-500">
                    {{ video.artistName }} - {{ video.trackName }}
                </span>
            </li>
        </SearchList>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import SearchList from '@/Components/SearchList.vue'

const props = defineProps({
    results: {
        type: Array
    }
})
</script>
