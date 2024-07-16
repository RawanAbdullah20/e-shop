<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import ProductForm from "@/Pages/Admin/Product/ProductForm.vue";
import AdminLayout from "../Components/AdminLayout.vue";
import { ref } from "vue";
defineOptions({
    layout: AdminLayout,
});
const props = defineProps({
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
    form.post(route("admin.products.update", props.product.id), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            router.visit(route("admin.products.index"));
        },

        onError: () => {},
    });
};
</script>

<template>
    <ProductForm @submit="submit" :product="product" ref="productFormRef" />
</template>
useForm,
