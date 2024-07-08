<script setup lang="ts">
import {
    ArrowLeftEndOnRectangleIcon,
    ChartPieIcon,
    GlobeAsiaAustraliaIcon,
    ShoppingBagIcon,
    ShoppingCartIcon,
    TagIcon,
    UsersIcon,
} from "@heroicons/vue/24/solid";
import { Link, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const sideBarList = ref([
    {
        icon: ChartPieIcon,
        title: "Dashboard",
        link: "admin.dashboard",
    },
    {
        icon: ShoppingBagIcon,
        title: "Products",
        link: "admin.products.index",
    },
    {
        icon: TagIcon,
        title: "Category",
        link: "admin.dashboard",
    },
    {
        icon: GlobeAsiaAustraliaIcon,
        title: "Brands",
        link: "admin.dashboard",
    },
    {
        icon: ShoppingCartIcon,
        title: "Orders",
        link: "admin.dashboard",
    },
    {
        icon: UsersIcon,
        title: "Users",
        link: "admin.dashboard",
    },
]);
</script>

<template>
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav"
        id="drawer-navigation"
    >
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <ul class="space-y-4">
                <li v-for="(list, index) in sideBarList" :key="index">
                    <Link
                        :href="route(list.link)"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        :class="
                            route().current(list.link) ? 'dark:bg-gray-700' : ''
                        "
                    >
                        <component
                            :is="list.icon"
                            class="size-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        />
                        <span class="ml-3">{{ list.title }}</span>
                    </Link>
                </li>
            </ul>
        </div>
        <div
            class="absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20"
        >
            <Link
                :href="route('logout')"
                method="post"
                role="button"
                as="link"
                class="flex w-full gap-2 items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:bg-gray-700 group"
            >
                <ArrowLeftEndOnRectangleIcon
                    class="size-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                />
                Sign out</Link
            >
        </div>
    </aside>
</template>
