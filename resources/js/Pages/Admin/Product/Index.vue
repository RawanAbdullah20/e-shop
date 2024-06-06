<script setup lang="ts">
import AdminLayout from "../../Admin/Components/AdminLayout.vue";
import ProductList from "./ProductList.vue";
defineOptions({
    layout: AdminLayout,
});
defineProps({
    products: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div>
        <ProductList :products />
    </div>
</template>
