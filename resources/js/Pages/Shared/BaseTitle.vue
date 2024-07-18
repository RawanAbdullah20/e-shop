<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <h1
        class="m-0 text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2"
    >
        {{ title }}
    </h1>
</template>
