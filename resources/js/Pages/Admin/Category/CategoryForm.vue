<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    category?: {
        name: string;
        slug: string;
        id: number;
    } | null;
}>();
const emit = defineEmits<{
    (event: "close"): void;
}>();

const form = useForm({
    name: props.category?.name ?? "",
});

const submit = () => {
    if (props.category) {
        form.post(route("admin.categories.update", props.category.id), {
            onSuccess: () => {
                form.reset();
                emit("close");
            },
            onError: () => {},
        });
        return;
    }
    form.post(route("admin.categories.store"), {
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
                <label for="name" class="labelClass"> Category Name </label>
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
                {{ category ? "Edit Category" : "Create Category" }}
            </button>
        </div>
    </form>
</template>
