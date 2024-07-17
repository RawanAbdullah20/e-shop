<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
const emit = defineEmits<{
    (event: "close"): void;
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
    password: props.user ? undefined : "",
    isAdmin: props.user?.isAdmin ? true : false,
});
const submit = () => {
    if (props.user) {
        form.put(route("admin.users.update", props.user?.id), {
            onSuccess: () => {
                form.reset();
                emit("close");
            },
            onError: () => {},
        });
        return;
    }
    form.post(route("admin.users.store"), {
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
                    :disabled="props.user ? true : false"
                    class="inputGray disabled:opacity-50"
                    placeholder="User Email"
                />
                <p class="error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </p>
            </div>
            <div v-if="!user">
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
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input
                            id="isAdmin"
                            type="checkbox"
                            v-model="form.isAdmin"
                            class="w-4 h-4 border rounded dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:focus:ring-offset-gray-800"
                        />
                    </div>
                    <label for="isAdmin" class="ms-2 labelClass"
                        >Is Admin</label
                    >
                </div>
            </div>
            <div class="flex justify-end w-full">
                <button
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="btn"
                >
                    {{ user ? "Edit User" : "Create User" }}
                </button>
            </div>
        </div>
    </form>
</template>
