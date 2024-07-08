<script setup lang="ts">
import MediaUploader from "@/Pages/Shared/MediaUploader.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed, onMounted, type ComputedRef } from "vue";
type Brand = { name: string; id: number };
const emit = defineEmits<{
    (event: "submit"): void;
}>();
const props = defineProps({
    product: {
        type: Object,
        required: false,
    },
});
const uploadedMediaIds: ComputedRef<number[]> = computed(
    () => (usePage().props.flash as any).responseData as number[]
);
const brands: ComputedRef<Brand[]> = computed(
    () => usePage().props.brands as Brand[]
);
const categories: ComputedRef<Brand[]> = computed(
    () => usePage().props.categories as Brand[]
);
const form = useForm({
    title: props.product?.title ?? "",
    description: props.product?.description ?? "",
    price: props.product?.price ?? "",
    quantity: props.product?.quantity ?? "",
    category_id: props.product?.category_id ?? "",
    brand_id: props.product?.brand_id ?? "",
    media_ids: props.product?.media_ids ?? [],
});
const mediaFiles = useForm({
    media: [] as string[],
});
const submit = () => {
    mediaFiles.post(route("admin.products.storeImage"), {
        onSuccess: () => {
            form.media_ids = uploadedMediaIds.value;
            emit("submit");
        },
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            console.error(errors);
        },
    });
};

defineExpose({
    form,
});

onMounted(() => {
    if (props.product) {
        props.product.media.forEach((media: any) => {
            mediaFiles.media.push(`/${media.media}`);
        });
    }
});
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="labelClass">Name</label>
                <input
                    type="text"
                    v-model="form.title"
                    id="name"
                    class="inputGray"
                    placeholder="Type product name"
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
                    class="inputGray"
                    v-model="form.description"
                    placeholder="Write product description here"
                ></textarea>
                <p class="error" v-if="form.errors.description">
                    {{ form.errors.description }}
                </p>
            </div>
            <div class="sm:col-span-2">
                <label class="labelClass"> Image </label>
                <MediaUploader
                    v-model:images="mediaFiles.media"
                    :is-updated="true"
                />
            </div>
        </div>
        <div class="flex justify-end w-full">
            <button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="btn"
            >
                {{ product ? "Edit Product" : "Create Product" }}
            </button>
        </div>
    </form>
</template>
