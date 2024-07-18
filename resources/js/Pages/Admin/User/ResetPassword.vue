<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
const emit = defineEmits<{
    (event: "close"): void;
}>();
const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("admin.users.reset", props.user?.id), {
        onSuccess: () => {
            emit("close");
            form.reset();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <label for="password" class="labelClass">Password</label>

            <input
                v-model="form.password"
                id="password"
                type="password"
                required
                autocomplete="new-password"
                class="inputGray"
                placeholder="Password"
            />
            <p class="error" v-if="form.errors.password">
                {{ form.errors.password }}
            </p>
        </div>
        <div class="flex justify-end w-full mt-3">
            <button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="btn"
            >
                Reset Password
            </button>
        </div>
    </form>
</template>
