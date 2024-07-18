<script setup lang="ts">
import BaseTable from "@/Pages/Shared/BaseTable.vue";
import Dialog from "@/Pages/Shared/Dialog.vue";
import UserForm from "./UserForm.vue";

import {
    PlusIcon,
    ShieldCheckIcon,
    ShieldExclamationIcon,
} from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import { ref, type Ref } from "vue";
import AdminLayout from "../Components/AdminLayout.vue";
import ResetPassword from "./ResetPassword.vue";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    users: {
        type: Object,
        required: true,
    },
});
const openCreateDialog: Ref<boolean> = ref(false);
const openEditDialog: Ref<boolean> = ref(false);
const openResetPassword: Ref<boolean> = ref(false);
const user: Ref<any> = ref(null);
const editDialog = (item: any) => {
    user.value = item;
    openEditDialog.value = true;
};
const resetDialog = (item: any) => {
    user.value = item;
    openResetPassword.value = true;
};
</script>

<template>
    <Dialog
        size="md"
        v-model:openDialog="openCreateDialog"
        title="Add new Brand"
    >
        <UserForm @close="openCreateDialog = false" />
    </Dialog>
    <Dialog size="md" v-model:openDialog="openEditDialog" title="Edit Brand">
        <UserForm @close="openEditDialog = false" :user="user" />
    </Dialog>
    <Dialog
        size="md"
        v-model:openDialog="openResetPassword"
        title="Reset Password"
    >
        <ResetPassword @close="openResetPassword = false" :user="user" />
    </Dialog>
    <BaseTable
        title="All Users"
        :data="users"
        :columns="[
            { key: 'name', label: 'User Name' },
            { key: 'email', label: 'Email' },
            { key: 'isAdmin', label: 'Admin' },
            { key: 'created_at', label: 'Created Date' },
            { key: 'actions', label: ' ' },
        ]"
    >
        <template #btn>
            <button class="btn gap-2" @click.prevent="openCreateDialog = true">
                <PlusIcon class="size-5" />
                Add new User
            </button>
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
                <p
                    @click.prevent="editDialog(item)"
                    class="text-violet-500 hover:text-red-700"
                >
                    Edit
                </p>
                <Link
                    :href="route('admin.users.delete', item.id)"
                    method="delete"
                    preserve-scroll
                    preserve-state
                    as="button"
                    class="p-0 text-red-500 hover:text-red-700"
                >
                    Delete
                </Link>
                <p
                    @click.prevent="resetDialog(item)"
                    class="text-secondary hover:text-red-700"
                >
                    Reset Password
                </p>
            </div>
        </template>
    </BaseTable>
</template>
