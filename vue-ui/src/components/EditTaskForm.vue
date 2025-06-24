<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import getCookie from "../utils/getCookie";

const props = defineProps({ task: Object });
const emit = defineEmits(["close", "edited"]);

const newNameRef = ref("");
const errorRef = ref(null);
const successRef = ref(null);

async function handleEdit() {
    successRef.value = null;
    errorRef.value = null;
    if (newNameRef.value === "") {
        errorRef.value = "New name can not be empty";
    }

    try {
        await axios.put(
            `${import.meta.env.VITE_API_ENDPOINT}/api/v1/tasks/update`,
            {
                id: props.task.id,
                name: newNameRef.value,
                is_completed: props.task.is_completed,
            },
            {
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${getCookie("token")}`,
                },
            }
        );
    } catch (error) {
        if (error.message) {
            errorRef.value = error.message;
            return;
        }

        errorRef.value = "Something went wrong while saving data";
    }

    successRef.value = "Task updated!";
    emit("edited", newNameRef.value, props.task.id);
}
</script>

<template>
    <div
        class="font-primary fixed inset-0 z-50 flex items-center justify-center"
    >
        <div
            class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-md border-2 border-orange-500"
        >
            <button
                @click="emit('close')"
                class="absolute top-2 right-2 text-red-500 hover:text-red-600 text-xl font-bold focus:outline-none cursor-pointer"
                aria-label="Close"
            >
                x
            </button>

            <form @submit.prevent="handleEdit" class="space-y-5">
                <div>
                    <label
                        for="Name"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Current name: {{ props.task.name }}
                    </label>
                    <input
                        id="Name"
                        type="text"
                        required
                        placeholder="New task name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        v-model="newNameRef"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-400 transition cursor-pointer"
                    :click="handleEdit"
                >
                    Edit
                </button>
                <p v-if="errorRef" class="text-center text-red-500">
                    {{ errorRef }}
                </p>
                <p v-if="successRef" class="text-center text-green-500">
                    {{ successRef }}
                </p>
            </form>
        </div>
    </div>
</template>
