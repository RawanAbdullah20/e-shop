<script setup lang="ts">
import { initFlowbite } from "flowbite";
import { onMounted } from "vue";
onMounted(() => {
    initFlowbite();
});
import NavBar from "../../Shared/NavBar.vue";
import SideBar from "./SideBar.vue";
</script>

<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <NavBar />
        <SideBar />

        <main class="p-4 md:ml-64 h-auto pt-20 min-h-[100vh]">
            <slot />
        </main>
    </div>
</template>
