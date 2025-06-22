<script setup>
import { RouterLink } from "vue-router";
import AppBar from "../components/AppBar.vue";
function handleRegister() {}
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
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-400 transition cursor-pointer"
                >
                    Register
                </button>
            </form>

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
