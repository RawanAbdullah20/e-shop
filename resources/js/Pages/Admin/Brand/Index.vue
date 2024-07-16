<script setup lang="ts">
import BaseTable from "@/Pages/Shared/BaseTable.vue";
import Dialog from "@/Pages/Shared/Dialog.vue";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { ref } from "vue";
import AdminLayout from "../Components/AdminLayout.vue";
import BrandForm from "./BrandForm.vue";

import { Link } from "@inertiajs/vue3";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    brands: {
        type: Object,
        required: true,
    },
});
const openCreateDialog = ref<boolean>(false);
const openEditDialog = ref<boolean>(false);
const brand = ref<any>(null);
const editDialog = (item: any) => {
    brand.value = item;
    openEditDialog.value = true;
};
</script>

<template>
    <Dialog
        size="md"
        v-model:openDialog="openCreateDialog"
        title="Add new Brand"
    >
        <BrandForm @close="openCreateDialog = false" />
    </Dialog>
    <Dialog size="md" v-model:openDialog="openEditDialog" title="Edit Brand">
        <BrandForm @close="openEditDialog = false" :brand="brand" />
    </Dialog>
    <BaseTable
        title="All Brands"
        :data="brands"
        :columns="[
            { key: 'name', label: 'Brand' },
            { key: 'actions', label: '' },
        ]"
    >
        <template #btn>
            <button class="btn gap-2" @click.prevent="openCreateDialog = true">
                <PlusIcon class="size-5" />
                Add new Brand
            </button>
        </template>

        <template #actions="{ item }">
            <div class="flex flex-col gap-2 text-center">
                <p
                    @click.prevent="editDialog(item)"
                    class="text-violet-500 hover:text-red-700"
                >
                    Edit
                </p>
                <Link
                    :href="route('admin.brands.delete', item)"
                    method="post"
                    preserve-scroll
                    preserve-state
                    as="button"
                    class="p-0 text-red-500 hover:text-red-700"
                >
                    Delete
                </Link>
            </div>
        </template>
    </BaseTable>
</template>
