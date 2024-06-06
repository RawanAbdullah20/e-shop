<script setup lang="ts">
import Dialog from "@/Pages/Shared/Dialog.vue";
import Pagination from "@/Pages/Shared/Pagination.vue";
import { PlusIcon } from "@heroicons/vue/20/solid";
import CreateProduct from "@/Pages/Admin/Product/CreateProduct.vue";
import { computed, ref } from "vue";
const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
});

const productList = computed(() => {
    return props.products.data;
});
const isOpenAdd = ref(false);
</script>

<template>
    <Dialog v-model:openDialog="isOpenAdd" title="Create Product" size="lg">
        <CreateProduct @close="isOpenAdd = false" />
    </Dialog>
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
            <button
                @click.prevent="isOpenAdd = true"
                type="button"
                class="flex gap-2 items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
            >
                <PlusIcon class="size-5" />
                Add new product
            </button>
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
                            class="flex items-center px-4 py-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <!-- <img
                                src="https://flowbite.s3.amazonaws.com/blocks/application-ui/devices/benq-ex2710q.png"
                                alt="iMac Front Image"
                                class="w-auto h-8 mr-3"
                            /> -->
                            {{ product.title }}
                        </th>
                        <td class="px-4 py-2">
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300"
                                >{{ product.category_id }}</span
                            >
                        </td>

                        <td
                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ product.brand_id }}
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
