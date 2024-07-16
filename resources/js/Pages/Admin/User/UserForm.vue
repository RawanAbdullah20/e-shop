<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import { computed, onMounted, type ComputedRef } from "vue";
const emit = defineEmits<{
    (event: "submit"): void;
}>();
const props = defineProps({
    user: {
        type: Object,
        required: false,
    },
});
const form = useForm({
    name: props.user?.name ?? "",
    email: props.user?.email ?? "",
    password: "",
    isAdmin: props.user?.isAdmin ?? false,
});
const submit = () => {
    emit("submit");
};
defineExpose({
    form,
});
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid gap-4 mb-4">
            <div>
                <label for="name" class="labelClass">User Name</label>
                <input
                    type="text"
                    v-model="form.name"
                    id="name"
                    class="inputGray"
                    placeholder="User name"
                />
                <p class="error" v-if="form.errors.name">
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label for="email" class="labelClass">Email</label>
                <input
                    type="email"
                    name="email"
                    v-model="form.email"
                    id="email"
                    class="inputGray"
                    placeholder="User Email"
                />
                <p class="error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </p>
            </div>
            <div>
                <label for="password" class="labelClass">Password</label>
                <input
                    type="password"
                    name="password"
                    v-model="form.password"
                    id="password"
                    class="inputGray"
                    placeholder="User Password"
                />
                <p class="error" v-if="form.errors.password">
                    {{ form.errors.password }}
                </p>
            </div>
            <div>
                <label for="isAdmin" class="labelClass">Is Admin</label>
                <input
                    type="checkbox"
                    name="isAdmin"
                    v-model="form.isAdmin"
                    id="isAdmin"
                />
                <p class="error" v-if="form.errors.isAdmin">
                    {{ form.errors.isAdmin }}
                </p>
            </div>
            <div class="flex justify-end w-full">
                <button
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="btn"
                >
                    {{ user ? "Edit Product" : "Create Product" }}
                </button>
            </div>
        </div>
    </form>
</template>
