<script setup lang="ts">
import UserForm from "@/Pages/Admin/User/UserForm.vue";
import { ref } from "vue";
import AdminLayout from "../Components/AdminLayout.vue";
defineOptions({
    layout: AdminLayout,
});
const userFormRef = ref<InstanceType<typeof UserForm> | null>(null);

const submit = () => {
    const form = userFormRef.value?.form;
    if (!form) {
        return;
    }
    form.post(route("admin.users.store"), {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {},
    });
};
</script>

<template>
    <UserForm @submit="submit" ref="userFormRef" />
</template>
