<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap -mb-1 mt-6 justify-center">
        <template v-for="(link, p) in links" :key="p">
            <div
                v-if="link.url === null"
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded-lg bg-gray-50/50 dark:bg-gray-800/50 dark:border-gray-700 dark:text-gray-500"
                v-html="link.label"
            />
            <Link
                v-else
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/30 focus:border-indigo-500 focus:text-indigo-500 transition-colors"
                :class="{ 'bg-indigo-500 text-white hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-500 border-transparent': link.active, 'bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:text-indigo-500': !link.active }"
                :href="link.url"
                v-html="link.label"
            />
        </template>
    </div>
</template>
