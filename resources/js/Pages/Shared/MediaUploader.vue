<script setup lang="ts">
import { ArrowUpCircleIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ComputedRef, computed } from "vue";

const images = defineModel<{ id: number; url: string }[]>("images", {
    required: true,
});
const uploadedMediaIds: ComputedRef<{ id: number; url: string }[]> = computed(
    () =>
        (usePage().props.flash as any).responseData as {
            id: number;
            url: string;
        }[]
);
const form = useForm({
    media: null as File[] | null,
});
const uploadImage = (e: Event) => {
    const files = (e.target as HTMLInputElement)?.files ?? null;
    if (files) {
        form.media = Array.from(files);
    }
    form.post(route("admin.media.storeImage"), {
        onSuccess: () => {
            images.value.push(...uploadedMediaIds.value);
        },
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            console.error(errors);
        },
    });
};
const filesPreview: ComputedRef<{ url: string; id: number }[]> = computed(
    () => {
        if (images.value) {
            return Array.from(images.value).map((file) => {
                return { url: file.url, id: file.id };
            });
        }
        return [];
    }
);
const deleteImage = (index: number, id: number) => {
    if (images.value) {
        images.value.splice(index, 1);
        router.delete(route("admin.media.delete", id), {
            preserveScroll: true,
            preserveState: true,
        });
    }
};
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div>
            <div class="flex items-center justify-center">
                <label
                    for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                >
                    <div
                        class="flex flex-col items-center justify-center gap-2 pt-5 pb-6"
                    >
                        <ArrowUpCircleIcon class="size-10 text-gray-500" />
                        <p
                            class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                        >
                            <span class="font-semibold">Click to upload</span>
                            or drag and drop
                        </p>
                    </div>
                    <input
                        id="dropzone-file"
                        type="file"
                        class="hidden"
                        multiple
                        @change="uploadImage"
                    />
                </label>
            </div>
        </div>
        <div
            class="relative flex rounded-lg cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 justify-center items-center group"
            v-for="(preview, index) in filesPreview"
            :key="index"
        >
            <img :src="preview.url" class="h-48 object-cover max-w-full p-6" />
            <div
                class="absolute top-2 right-2 bg-gray-800 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                @click.prevent="deleteImage(index, preview.id)"
            >
                <XMarkIcon class="size-6" />
            </div>
        </div>
    </div>
</template>
