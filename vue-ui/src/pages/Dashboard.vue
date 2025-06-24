<script setup>
import { ref, onMounted } from "vue";
import AppBar from "../components/AppBar.vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";
import getCookie from "../utils/getCookie";
import EditTaskForm from "../components/EditTaskForm.vue";

const route = useRoute();
const router = useRouter();

const tasks = ref([]);
const newTask = ref("");
const apiError = ref(null);

const editRef = ref(false);

onMounted(async () => {
    try {
        const response = await axios.get(
            "http://localhost:8000/api/v1/users/getUser",
            {
                headers: {
                    Authorization: `Bearer ${getCookie("token")}`,
                    Accept: "application/json",
                },
            }
        );

        if (
            response.data.id != localStorage.getItem("id") &&
            response.data.id != route.params.id
        ) {
            router.push("/login");
        }
    } catch (error) {
        console.error("AUTH ERROR:", error);
        router.push("/login");
    }

    try {
        const response = await axios.get(
            "http://localhost:8000/api/v1/tasks/",
            {
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${getCookie("token")}`,
                },
            }
        );

        tasks.value = response.data.data;
    } catch (error) {
        console.log(error);
    }
});

async function addTask() {
    apiError.value = null;
    if (newTask.value.trim() === "") return;
    tasks.value.push({
        id: Date.now(),
        name: newTask.value.trim(),
        completed: false,
    });

    try {
        await axios.post(
            "http://localhost:8000/api/v1/tasks/create",
            {
                name: newTask.value,
                is_completed: 0,
            },
            {
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${getCookie("token")}`,
                },
            }
        );
    } catch (error) {
        apiError.value = "Error occured while adding task to database";
    }

    newTask.value = "";
}

async function toggleTaskCompletion(taskId) {
    apiError.value = null;
    const task = tasks.value.find((t) => t.id === taskId);
    if (task) task.is_completed = !task.is_completed;
    console.log(tasks);

    try {
        await axios.put(
            "http://localhost:8000/api/v1/tasks/update",
            {
                id: taskId,
                is_completed: task.is_completed,
            },
            {
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${getCookie("token")}`,
                },
            }
        );
    } catch (error) {
        console.log(error);
        apiError.value = "Error occured while updating task in database";
    }
}

async function deleteTask(taskId) {
    apiError.value = null;
    tasks.value = tasks.value.filter((t) => t.id !== taskId);
    try {
        await axios.delete("http://localhost:8000/api/v1/tasks/delete", {
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${getCookie("token")}`,
            },
            data: {
                id: taskId,
            },
        });
    } catch (error) {
        console.log(error);
        apiError.value = "Error occured while deleting task in database";
    }
}

function editTask(taskId) {
    const task = tasks.value.find((x) => x.id === taskId);
    editRef.value = task;
}

function handleEditTaskClose() {
    editRef.value = null;
}

function handleEdited(newName, taskId) {
    const task = tasks.value.find((x) => x.id === taskId);
    if (task) {
        task.name = newName;
    }
}
</script>

<template>
    <AppBar />
    <div
        class="min-h-[calc(100vh-4rem)] px-4 py-8 font-primary max-w-screen overflow-x-hidden z-0"
    >
        <div
            v-if="editRef"
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30"
        >
            <EditTaskForm
                @close="handleEditTaskClose"
                @edited="handleEdited"
                :task="editRef"
            />
        </div>
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
                            :checked="task.is_completed"
                            @change="toggleTaskCompletion(task.id)"
                            class="w-5 h-5 text-orange-500 focus:ring-orange-500"
                        />
                        <span
                            :class="{
                                'line-through text-gray-400': task.is_completed,
                                'text-gray-800': !task.is_completed,
                            }"
                            class="text-lg font-medium"
                        >
                            {{ task.name }}
                        </span>
                    </div>
                    <div class="flex gap-3">
                        <button
                            @click="editTask(task.id)"
                            class="text-blue-500 hover:text-blue-600 font-semibold transition cursor-pointer"
                        >
                            Edit
                        </button>
                        <button
                            @click="deleteTask(task.id)"
                            class="text-red-500 hover:text-red-600 font-semibold transition cursor-pointer"
                        >
                            Delete
                        </button>
                    </div>
                </div>
                <p
                    v-if="apiError"
                    class="text-center relative top-2 text-red-500"
                >
                    {{ apiError }}
                </p>
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
