<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
const props = defineProps<{
    brand?: {
        name: string;
        slug: string;
        id: number;
    } | null;
}>();
const emit = defineEmits<{
    (event: "close"): void;
}>();

const form = useForm({
    name: props.brand?.name ?? "",
});

const submit = () => {
    if (props.brand) {
        form.post(route("admin.brands.update", props.brand.id), {
            onSuccess: () => {
                form.reset();
                emit("close");
            },
            onError: () => {},
        });
        return;
    }
    form.post(route("admin.brands.store"), {
        onSuccess: () => {
            form.reset();
            emit("close");
        },
        onError: () => {},
    });
};
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="labelClass"> Brand Name </label>
                <input
                    type="text"
                    v-model="form.name"
                    name="name"
                    id="name"
                    class="inputGray"
                />
                <p class="error" v-if="form.errors.name">
                    {{ form.errors.name }}
                </p>
            </div>
            <button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="btn w-full justify-center"
            >
                {{ brand ? "Edit Brand" : "Create Brand" }}
            </button>
        </div>
    </form>
</template>
