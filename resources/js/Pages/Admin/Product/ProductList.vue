<script setup lang="ts">
import Pagination from "@/Pages/Shared/Pagination.vue";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
});

const productList = computed(() => {
    return props.products.data;
});
</script>

<template>
    <div
        class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
    >
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4"
        >
            <h5>
                <span class="text-gray-500 me-2">All Products:</span>
                <span class="dark:text-white">{{ products.total }}</span>
            </h5>
            <Link
                :href="route('admin.products.create')"
                class="btn gap-2"
                as="button"
            >
                <PlusIcon class="size-5" />
                Add new product
            </Link>
        </div>
        <div class="overflow-x-auto">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-4 py-3">Product</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Brand</th>
                        <th scope="col" class="px-4 py-3">Quantity</th>
                        <th scope="col" class="px-4 py-3">Price</th>
                        <th scope="col" class="px-4 py-3">Stock</th>
                        <th scope="col" class="px-4 py-3">Published</th>
                        <th scope="col" class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="product in productList"
                        :key="product.id"
                        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                        <th
                            scope="row"
                            class="flex items-center px-4 py-6 font-medium text-gray-900 whitespace-nowrap max-w-56 dark:text-white"
                        >
                            <img
                                v-if="product.product_images?.length"
                                :src="`/${product.product_images[0].image}`"
                                :alt="product.title"
                                class="w-auto h-8 mr-3"
                            />
                            <p class="truncate">
                                {{ product.title }}
                            </p>
                        </th>
                        <td class="px-4 py-2">
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300"
                                >{{ product.category?.name }}</span
                            >
                        </td>

                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ product.brand?.name }}
                        </td>
                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <div class="flex items-center">
                                <div
                                    class="inline-block w-4 h-4 mr-2 rounded-full"
                                    :class="{
                                        'bg-green-500': product.quantity > 10,
                                        'bg-red-500': product.quantity <= 5,
                                        'bg-yellow-500':
                                            product.quantity > 5 &&
                                            product.quantity <= 10,
                                    }"
                                ></div>
                                {{ product.quantity }}
                            </div>
                        </td>
                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            ${{ product.price }}
                        </td>

                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ product.inStock }}
                        </td>
                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ product.published }}
                        </td>
                        <td class="px-4 py-2 flex flex-col gap-2 text-center">
                            <Link
                                :href="
                                    route('admin.products.edit', product.slug)
                                "
                                class="text-violet-500 hover:text-red-700"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="route('admin.products.delete', product)"
                                method="post"
                                preserve-scroll
                                preserve-state
                                as="button"
                                class="p-0 text-red-500 hover:text-red-700"
                            >
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            :links="products.links"
            :current_page="products.current_page"
            :total="products.total"
            :last_page="products.last_page"
        />
    </div>
</template>
