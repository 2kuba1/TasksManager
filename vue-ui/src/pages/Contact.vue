<script setup>
import AppBar from "../components/AppBar.vue";

function handleContactSubmit() {
    alert("Message sent! (You can replace this with your API logic)");
}
</script>

<template>
    <AppBar />

    <div
        class="min-h-[calc(100vh-4rem)] bg-gradient-to-br px-4 py-10 flex items-center justify-center font-primary"
    >
        <div
            class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-xl border-2 border-orange-500"
        >
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">
                Contact Us
            </h2>

            <form @submit.prevent="handleContactSubmit" class="space-y-5">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Name
                    </label>
                    <input
                        id="name"
                        type="text"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    />
                </div>

                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    />
                </div>

                <div>
                    <label
                        for="message"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Message
                    </label>
                    <textarea
                        id="message"
                        rows="5"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-400 transition cursor-pointer"
                >
                    Send Message
                </button>
            </form>
        </div>
    </div>
</template>
