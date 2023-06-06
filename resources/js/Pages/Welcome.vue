<script setup>
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    canLogin: {
        type: Boolean
    },
    canRegister: {
        type: Boolean
    },
    artists: {
        type: Array
    }
})
</script>

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

        <main>
            <form>
                <label for="search">
                    <input
                        id="search"
                        name="search"
                        type="search"
                        class="h-[150px] bg-transparent w-full text-8xl focus:outline-none"
                        placeholder="Start typing..."
                        autofocus
                    />
                </label>
            </form>
        </main>

        <footer class="h-24"></footer>
    </div>
</template>
