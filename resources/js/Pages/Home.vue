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

            <SearchSection :results="results" />
        </MainLayout>

        <footer class="h-24"></footer>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { debounce } from 'lodash'
import { Head, router } from '@inertiajs/vue3'
import HeaderLayout from '@/Layouts/HeaderLayout.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import SearchSection from '@/Components/SearchSection.vue'

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
