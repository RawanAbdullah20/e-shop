<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: {
        type: null,
        required: true,
    },
    total: {
        type: Number,
        required: true,
    },
    current_page: {
        type: Number,
        required: true,
    },
    last_page: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <nav
        class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
        aria-label="Table navigation"
    >
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ current_page }} - {{ last_page }}
            </span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ total }}
            </span>
        </span>

        <ul class="flex items-center -space-x-px h-8 text-sm">
            <li v-for="(link, index) in links" :key="link.label">
                <Link
                    :href="link?.url ? link?.url : links[index - 1]?.url"
                    preserveScroll
                    :class="
                        link.active
                            ? 'dark:bg-gray-900  dark:text-gray-100 '
                            : 'dark:bg-gray-800  dark:text-gray-400 '
                    "
                    class="flex items-center justify-center dark:border-gray-700 px-3 h-8 dark:hover:bg-gray-700 dark:hover:text-white leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                    <svg
                        v-if="!index"
                        class="w-2.5 h-2.5 rtl:rotate-180"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 6 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 1 1 5l4 4"
                        />
                    </svg>
                    <span
                        v-else-if="
                            link.url && index != links.length - 1 && index != 0
                        "
                    >
                        {{ link?.label }}
                    </span>

                    <svg
                        v-else-if="index == links.length - 1"
                        class="w-2.5 h-2.5 rtl:rotate-180"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 6 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 9 4-4-4-4"
                        />
                    </svg>
                    <span v-else>
                        {{ link?.label }}
                    </span>
                </Link>
            </li>
        </ul>
    </nav>
</template>
