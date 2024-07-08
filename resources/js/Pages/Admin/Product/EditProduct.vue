<script setup lang="ts">
import ProductForm from "@/Pages/Admin/Product/ProductForm.vue";
import AdminLayout from "../Components/AdminLayout.vue";
import { ref } from "vue";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    product: {
        type: Object,
        required: true,
    },
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
    <ProductForm @submit="submit" :product="product" ref="productFormRef" />
</template>
useForm,
