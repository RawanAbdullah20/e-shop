<script setup lang="ts">
import ProductForm from "@/Pages/Admin/Product/ProductForm.vue";
import { ref } from "vue";
import AdminLayout from "../Components/AdminLayout.vue";
defineOptions({
    layout: AdminLayout,
});
const productFormRef = ref<InstanceType<typeof ProductForm> | null>(null);

const submit = () => {
    const form = productFormRef.value?.form;
    if (!form) {
        return;
    }
    form.post(route("admin.products.store"), {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {},
    });
};
</script>

<template>
    <ProductForm @submit="submit" ref="productFormRef" />
</template>
