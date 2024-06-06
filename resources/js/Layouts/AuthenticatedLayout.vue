<script setup lang="ts">
import { initFlowbite } from "flowbite";
import { onMounted } from "vue";
onMounted(() => {
    initFlowbite();
});
import NavBar from "../Pages/Shared/NavBar.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <NavBar />

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
