<script setup lang="ts">
import Pagination from "@/Pages/Shared/Pagination.vue";
import { computed } from "vue";

interface Column {
    key: string;
    label: string;
    formatter?: (item: any) => string;
}
interface TableProps {
    data: any;
    columns: Column[];
    title: string;
}
const props = defineProps<TableProps>();
const tableData = computed(() => props.data?.data);
const tableColumns = computed(() => props.columns);
</script>

<template>
    <div
        class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
    >
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4"
        >
            <h5>
                <span class="text-gray-500 me-2">{{ title }}</span>
                <span class="dark:text-white">{{ data.total }}</span>
            </h5>
            <slot name="btn"></slot>
        </div>
        <div class="overflow-x-auto">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th
                            v-for="column in tableColumns"
                            :key="column.key"
                            scope="col"
                            class="px-4 py-3"
                        >
                            {{ column.label }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in tableData"
                        :key="index"
                        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                        <td
                            v-for="column in tableColumns"
                            :key="column.key"
                            class="px-4 py-2 whitespace-nowrap max-w-56 truncate"
                        >
                            <slot :name="column.key" :item="item">
                                {{
                                    column.formatter
                                        ? column.formatter(item)
                                        : item[column.key]
                                }}
                            </slot>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination
                :links="data.links"
                :current_page="data.current_page"
                :total="data.total"
                :last_page="data.last_page"
            />
        </div>
    </div>
</template>
