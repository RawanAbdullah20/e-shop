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
    const formData = new FormData();
    formData.append("title", form.title);
    formData.append("description", form.description);
    formData.append("price", form.price);
    formData.append("quantity", form.quantity);
    formData.append("category_id", form.category_id);
    formData.append("brand_id", form.brand_id);
    if (form.product_images) {
        Array.from(form.product_images).forEach((file) => {
            formData.append("product_images[]", file);
        });
    }
    form.post(route("admin.products.store"), {
        data: formData,
        headers: {
            "Content-Type": "multipart/form-data",
        },
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
