<script setup>
import { RouterLink, useRoute, useRouter } from "vue-router";
import AppBar from "../components/AppBar.vue";
import axios from "axios";
import { ref } from "vue";

const emailRef = ref("");
const passwordRef = ref("");
const loginErrorRef = ref(null);
const router = useRouter();
const route = useRoute();

async function handleLogin() {
    route.params.success = "";
    loginErrorRef.value = "";

    try {
        const response = await axios.post(
            "http://localhost:8000/api/v1/users/login",
            {
                email: emailRef.value,
                password: passwordRef.value,
            },
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );

        document.cookie = `token=${response.data.token}; path=/; SameSite=Lax`;
        localStorage.setItem("name", response.data.user.name);
        localStorage.setItem("id", response.data.user.id);
        localStorage.setItem("role_id", response.data.user.role_id);
        localStorage.setItem("email", response.data.user.email);

        router.push({
            path: `/dashboard/${response.data.user.id}`,
        });
    } catch (error) {
        loginErrorRef.value = error;
        console.log(error);
    }
}
</script>

<template>
    <AppBar :logged="true" />
    <div
        class="h-[calc(100vh-4rem)] bg-gradient-to-br flex items-center justify-center px-4 font-primary"
    >
        <div
            class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md border-2 border-orange-500"
        >
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Task Manager
            </h2>

            <form @submit.prevent="handleLogin" class="space-y-5">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                        for="email"
                        >Email</label
                    >
                    <input
                        id="email"
                        type="email"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        v-model="emailRef"
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                        for="password"
                        >Password</label
                    >
                    <input
                        id="password"
                        type="password"
                        required
                        v-model="passwordRef"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:focus:ring-orange-500"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-400 transition cursor-pointer"
                >
                    Login
                </button>
            </form>
            <p
                v-if="loginErrorRef"
                class="text-center relative top-2 text-red-500"
            >
                Invalid Credentials
            </p>
            <p
                v-if="route.params.success == 'loginSuccess'"
                class="text-green-500 text-center relative top-2"
            >
                Registered successfully
            </p>
            <p class="text-sm text-center text-gray-600 mt-6">
                Don’t have an account?
                <RouterLink
                    to="/register"
                    class="text-orange-500 hover:underline font-medium"
                    >Sign up</RouterLink
                >
            </p>
        </div>
    </div>
</template>
