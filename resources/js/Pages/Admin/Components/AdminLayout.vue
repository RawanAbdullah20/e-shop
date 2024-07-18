<script setup lang="ts">
import BaseTitle from "@/Pages/Shared/BaseTitle.vue";
import { initFlowbite } from "flowbite";
import { onMounted } from "vue";
import { Head } from "@inertiajs/vue3";

onMounted(() => {
    initFlowbite();
});

defineProps({
    title: {
        type: String,
        required: true,
    },
});

import NavBar from "../../Shared/NavBar.vue";
import SideBar from "./SideBar.vue";
</script>

<template>
    <Head :title="title" />

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <NavBar />
        <SideBar />

        <main class="p-4 md:ml-64 h-auto pt-20 min-h-[100vh]">
            <BaseTitle :title="title" />
            <slot />
        </main>
    </div>
</template>
