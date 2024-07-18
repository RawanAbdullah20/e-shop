<script setup lang="ts">
import AdminLayout from "../../Admin/Components/AdminLayout.vue";
import Pagination from "@/Pages/Shared/Pagination.vue";
import Dialog from "@/Pages/Shared/Dialog.vue";
import { ref, type Ref } from "vue";

defineOptions({
    layout: AdminLayout,
});
const props = defineProps({
    medias: {
        type: Object,
        required: true,
    },
});
const openDialog: Ref<boolean> = ref(false);
const media: Ref<any> = ref(null);
const openMediaDialog = (item: any) => {
    media.value = item;
    openDialog.value = true;
};
</script>
<template>
    <Dialog
        size="xxl"
        v-model:openDialog="openDialog"
        :title="openDialog ? media?.original_filename : ''"
    >
        <img
            class="h-full max-h-[70dvh] w-full object-contain object-center"
            :src="media.url"
            :alt="media.original_filename"
        />
    </Dialog>
    <div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
        >
            <div v-for="media in medias.data" :key="media.id">
                <div class="overflow-hidden" role="button">
                    <img
                        @click.prevent="openMediaDialog(media)"
                        class="h-52 min-w-full max-w-full rounded-lg transition-transform duration-300 ease-in-out hover:scale-110"
                        :src="media.url"
                        :alt="media.original_filename"
                    />
                </div>
            </div>
        </div>
        <Pagination
            :links="medias.links"
            :current_page="medias.current_page"
            :total="medias.total"
            :last_page="medias.last_page"
        />
    </div>
</template>
