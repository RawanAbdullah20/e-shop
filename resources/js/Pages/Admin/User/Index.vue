<script setup lang="ts">
import BaseTable from "@/Pages/Shared/BaseTable.vue";
import {
    PlusIcon,
    ShieldCheckIcon,
    ShieldExclamationIcon,
} from "@heroicons/vue/20/solid";
import { ref } from "vue";
import AdminLayout from "../Components/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    users: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <BaseTable
        title="All Brands"
        :data="users"
        :columns="[
            { key: 'name', label: 'User Name' },
            { key: 'email', label: 'Email' },
            { key: 'isAdmin', label: 'Admin' },
            { key: 'created_at', label: 'Created Date' },
        ]"
    >
        <template #btn>
            <Link
                :href="route('admin.users.create')"
                class="btn gap-2"
                as="button"
            >
                <PlusIcon class="size-5" />
                Add new User
            </Link>
        </template>

        <template #isAdmin="{ item }">
            <ShieldCheckIcon
                v-if="item.isAdmin"
                class="size-6 dark:text-secondary"
            /><ShieldExclamationIcon
                v-else
                class="size-6 dark:text-primary-500"
            />
        </template>
        <template #actions="{ item }">
            <div class="flex flex-col gap-2 text-center">
                <!-- <Link
                    :href="route('admin.users.delete', item)"
                    method="post"
                    preserve-scroll
                    preserve-state
                    as="button"
                    class="p-0 text-red-500 hover:text-red-700"
                >
                    Delete
                </Link> -->
            </div>
        </template>
    </BaseTable>
</template>
