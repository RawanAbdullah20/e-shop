<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true,
    },
    size: {
        type: String,
        default: "md",
    },
});
const openDialog = defineModel<boolean | undefined>("openDialog", {
    required: true,
});
</script>

<template>
    <Teleport to="body">
        <div
            v-if="openDialog"
            @click.prevent="() => (openDialog = false)"
            class="overflow-y-auto overflow-x-hidden flex justify-center items-center fixed top-0 bottom-0 right-0 z-50 justify-center items-center w-full dark:bg-gray-600/50 h-[calc(100%-1rem)]"
        >
            <div
                class="w-full max-w-2xl m-auto"
                :class="{
                    'max-w-md': size === 'sm',
                    'max-w-xl': size === 'md',
                    'max-w-3xl': size === 'lg',
                    'max-w-4xl': size === 'xl',
                    'max-w-screen-xl': size === 'xxl',
                }"
                @click.stop=""
            >
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-800"
                >
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            {{ title }}
                        </h3>
                        <button
                            type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click.prevent="() => (openDialog = false)"
                        >
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>
