<script setup>
import { RouterLink } from "vue-router";
import AppBar from "../components/AppBar.vue";
</script>

<template>
    <AppBar />
    <main
        class="h-[calc(100vh-4rem)] flex flex-row items-center justify-center gap-5 font-primary"
    >
        <RouterLink
            to="/login"
            class="h-14 w-24 text-white bg-orange-500 rounded-2xl hover:scale-125 transition flex items-center justify-center"
        >
            Login
        </RouterLink>
        <RouterLink
            to="/rgister"
            class="h-14 w-24 border-2 border-orange-500 text-orange-500 rounded-2xl hover:scale-125 transition flex items-center justify-center"
        >
            Register
        </RouterLink>
    </main>
</template>
