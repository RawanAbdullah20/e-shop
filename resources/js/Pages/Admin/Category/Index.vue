<script setup lang="ts">
import BaseTable from "@/Pages/Shared/BaseTable.vue";
import Dialog from "@/Pages/Shared/Dialog.vue";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import AdminLayout from "../../Admin/Components/AdminLayout.vue";
import CategoryForm from "./CategoryForm.vue";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
const openCreateDialog = ref<boolean>(false);
const openEditDialog = ref<boolean>(false);
const category = ref<any>(null);
const editDialog = (item: any) => {
    category.value = item;
    openEditDialog.value = true;
};
</script>

<template>
    <Dialog
        size="md"
        v-model:openDialog="openCreateDialog"
        title="Add new Category"
    >
        <CategoryForm @close="openCreateDialog = false" />
    </Dialog>
    <Dialog size="md" v-model:openDialog="openEditDialog" title="Edit Category">
        <CategoryForm @close="openEditDialog = false" :category="category" />
    </Dialog>
    <BaseTable
        title="All Categories"
        :data="categories"
        :columns="[
            { key: 'name', label: 'Category' },
            { key: 'actions', label: '' },
        ]"
    >
        <template #btn>
            <button class="btn gap-2" @click.prevent="openCreateDialog = true">
                <PlusIcon class="size-5" />
                Add new Category
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
                    :href="route('admin.categories.delete', item.id)"
                    method="delete"
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
