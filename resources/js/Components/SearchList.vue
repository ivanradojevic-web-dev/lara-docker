<template>
    <div class="col-span-6 md:col-span-3 lg:col-span-2">
        <div class="border-b border-gray-500 flex justify-between items-center">
            <span class="text-sm"> {{ title }} </span>
            <span class="text-sm"> {{ label }} </span>
        </div>
        <ul v-auto-animate class="mt-6 flex flex-col space-y-2.5">
            <slot></slot>
        </ul>
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String
    },
    label: {
        type: String
    }
})
</script>
