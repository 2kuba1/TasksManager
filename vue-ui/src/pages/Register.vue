<script setup>
import { RouterLink } from "vue-router";
import AppBar from "../components/AppBar.vue";
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const nameRef = ref("");
const emailRef = ref("");
const passwordRef = ref("");
const confirmPasswordRef = ref("");
const validationErrorRef = ref(null);

async function handleRegister() {
    validationErrorRef.value = null;
    if (confirmPasswordRef.value !== passwordRef.value) {
        validationErrorRef.value = "Passwords are not the same";
        return;
    }

    const passwordRegex =
        /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

    if (!passwordRegex.test(passwordRef)) {
        validationErrorRef.value =
            "Password should be at least 8 signs long, contain one big letter, one special sign and one number";
        return;
    }

    try {
        await axios.post(
            "http://localhost:8000/api/v1/users/register",
            {
                name: nameRef.value,
                email: emailRef.value,
                password: passwordRef.value,
            },
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );

        router.push("/login/loginSuccess");
    } catch (error) {
        validationErrorRef.value = error.message;
    }
}
</script>

<template>
    <AppBar />
    <div
        class="h-[calc(100vh-4rem)] bg-gradient-to-br flex items-center justify-center px-4 font-primary"
    >
        <div
            class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md border-2 border-orange-500"
        >
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Create Account
            </h2>

            <form @submit.prevent="handleRegister" class="space-y-5">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                        for="name"
                        >Name</label
                    >
                    <input
                        id="name"
                        type="text"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        v-model="nameRef"
                    />
                </div>

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
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        v-model="passwordRef"
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                        for="confirm-password"
                        >Confirm Password</label
                    >
                    <input
                        id="confirm-password"
                        type="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        v-model="confirmPasswordRef"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-400 transition cursor-pointer"
                >
                    Register
                </button>
            </form>
            <p
                v-if="validationErrorRef"
                class="text-center relative top-2 text-red-500"
            >
                {{ validationErrorRef }}
            </p>
            <p class="text-sm text-center text-gray-600 mt-6">
                Already have an account?
                <RouterLink
                    to="/login"
                    class="text-orange-500 hover:underline font-medium"
                    >Login</RouterLink
                >
            </p>
        </div>
    </div>
</template>
