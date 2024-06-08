<script setup lang="ts">
import MediaUploader from "@/Pages/Shared/MediaUploader.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ComputedRef, computed } from "vue";
const emit = defineEmits(["close"]);

type Brand = { name: string; id: number };
const brands: ComputedRef<Brand[]> = computed(
    () => usePage().props.brands as Brand[]
);
const categories: ComputedRef<Brand[]> = computed(
    () => usePage().props.categories as Brand[]
);
const form = useForm({
    title: "",
    description: "",
    price: "",
    quantity: "",
    category_id: "",
    brand_id: "",
    image: null as FileList | null,
});

const submit = () => {
    const formData = new FormData();
    formData.append("title", form.title);
    formData.append("description", form.description);
    formData.append("price", form.price);
    formData.append("quantity", form.quantity);
    formData.append("category_id", form.category_id);
    formData.append("brand_id", form.brand_id);
    if (form.image) {
        Array.from(form.image).forEach((file) => {
            formData.append("product_images[]", file);
        });
    }
    form.post(route("admin.products.store"), {
        data: formData,
        onSuccess: () => {
            emit("close");
            form.reset();
        },
        onError: () => {},
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="labelClass">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="inputGray"
                    placeholder="Type product name"
                    v-model="form.title"
                />
                <p class="error" v-if="form.errors.title">
                    {{ form.errors.title }}
                </p>
            </div>
            <div>
                <label for="price" class="labelClass">Price</label>
                <input
                    type="number"
                    name="price"
                    v-model="form.price"
                    id="price"
                    class="inputGray"
                    placeholder="Product price"
                />
                <p class="error" v-if="form.errors.price">
                    {{ form.errors.price }}
                </p>
            </div>
            <div>
                <label for="quantity" class="labelClass">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    class="inputGray"
                    v-model="form.quantity"
                    placeholder="Product quantity"
                />
                <p class="error" v-if="form.errors.quantity">
                    {{ form.errors.quantity }}
                </p>
            </div>
            <div>
                <label for="brand" class="labelClass">Brand</label>
                <select id="brand" class="inputGray" v-model="form.brand_id">
                    <option
                        v-for="brand in brands"
                        :key="brand.id"
                        :value="brand.id"
                    >
                        {{ brand.name }}
                    </option>
                </select>
                <p class="error" v-if="form.errors.brand_id">
                    {{ form.errors.brand_id }}
                </p>
            </div>
            <div>
                <label for="category" class="labelClass">Category</label>
                <select
                    id="category"
                    class="inputGray"
                    v-model="form.category_id"
                >
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <p class="error" v-if="form.errors.category_id">
                    {{ form.errors.category_id }}
                </p>
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="labelClass">Description</label>
                <textarea
                    id="description"
                    rows="4"
                    v-model="form.description"
                    class="inputGray"
                    placeholder="Write product description here"
                ></textarea>
                <p class="error" v-if="form.errors.description">
                    {{ form.errors.description }}
                </p>
            </div>
            <div class="sm:col-span-2">
                <label class="labelClass"> Image </label>
                <MediaUploader v-model:images="form.image" />
            </div>
        </div>

        <button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            class="btn"
        >
            Add new product
        </button>
    </form>
</template>

<style></style>
