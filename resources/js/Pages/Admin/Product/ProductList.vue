<script setup lang="ts">
import BaseTable from "@/Pages/Shared/BaseTable.vue";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
defineProps({
    products: {
        type: Object,
        required: true,
    },
});
const columns = [
    { key: "title", label: "Product" },
    {
        key: "category",
        label: "Category",
        formatter: (item: any) => item.category?.name || "",
    },
    {
        key: "brand",
        label: "Brand",
        formatter: (item: any) => item.brand?.name || "",
    },
    { key: "quantity", label: "Quantity" },
    {
        key: "price",
        label: "Price",
        formatter: (item: any) => `$${item.price}`,
    },
    { key: "inStock", label: "Stock" },
    { key: "published", label: "Published" },
    { key: "actions", label: "" },
];
</script>
<template>
    <BaseTable title="All Products" :data="products" :columns="columns">
        <template #btn>
            <Link
                :href="route('admin.products.create')"
                class="btn gap-2"
                as="button"
            >
                <PlusIcon class="size-5" />
                Add new Product
            </Link>
        </template>
        <template #category="{ item }">
            <span
                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300"
            >
                {{ item.category?.name }}
            </span>
        </template>

        <template #quantity="{ item }">
            <div class="flex items-center">
                <div
                    class="inline-block w-4 h-4 mr-2 rounded-full"
                    :class="{
                        'bg-green-500': item.quantity > 10,
                        'bg-red-500': item.quantity <= 5,
                        'bg-yellow-500':
                            item.quantity > 5 && item.quantity <= 10,
                    }"
                ></div>
                {{ item.quantity }}
            </div>
        </template>

        <template #actions="{ item }">
            <div class="flex flex-col gap-2 text-center">
                <Link
                    :href="route('admin.products.edit', item.slug)"
                    class="text-violet-500 hover:text-red-700"
                >
                    Edit
                </Link>
                <Link
                    :href="route('admin.products.delete', item.id)"
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
