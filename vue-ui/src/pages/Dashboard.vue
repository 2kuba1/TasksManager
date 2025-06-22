<script setup>
import { ref } from "vue";
import AppBar from "../components/AppBar.vue";

const tasks = ref([{ id: 1, title: "xd", completed: false }]);

const newTask = ref("");

function addTask() {
    if (newTask.value.trim() === "") return;
    tasks.value.push({
        id: Date.now(),
        title: newTask.value.trim(),
        completed: false,
    });
    newTask.value = "";
}

function toggleTaskCompletion(taskId) {
    const task = tasks.value.find((t) => t.id === taskId);
    if (task) task.completed = !task.completed;
}

function deleteTask(taskId) {
    tasks.value = tasks.value.filter((t) => t.id !== taskId);
}
</script>

<template>
    <AppBar />
    <div
        class="min-h-[calc(100vh-4rem)] bg-gradient-to-br px-4 py-8 font-primary"
    >
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">
                Your Tasks
            </h2>

            <form
                @submit.prevent="addTask"
                class="mb-6 flex items-center space-x-2"
            >
                <input
                    v-model="newTask"
                    type="text"
                    placeholder="Enter a new task..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
                <button
                    type="submit"
                    class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-400 transition"
                >
                    Add
                </button>
            </form>

            <div class="space-y-4">
                <div
                    v-for="task in tasks"
                    :key="task.id"
                    class="flex items-center justify-between bg-white p-4 rounded-xl shadow border-2 border-orange-500"
                >
                    <div class="flex items-center space-x-4">
                        <input
                            type="checkbox"
                            :checked="task.completed"
                            @change="toggleTaskCompletion(task.id)"
                            class="w-5 h-5 text-orange-500 focus:ring-orange-500"
                        />
                        <span
                            :class="{
                                'line-through text-gray-400': task.completed,
                                'text-gray-800': !task.completed,
                            }"
                            class="text-lg font-medium"
                        >
                            {{ task.title }}
                        </span>
                    </div>

                    <button
                        @click="deleteTask(task.id)"
                        class="text-red-500 hover:text-red-600 font-semibold transition"
                    >
                        Delete
                    </button>
                </div>

                <div
                    v-if="tasks.length === 0"
                    class="text-center text-gray-600 mt-8"
                >
                    No tasks to show.
                </div>
            </div>
        </div>
    </div>
</template>
