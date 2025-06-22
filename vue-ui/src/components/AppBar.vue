<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
    <header
        class="w-full border-b-2 border-orange-500 h-16 font-primary flex flex-row items-center justify-center lg:justify-between px-4 lg:px-20 overflow-hidden"
    >
        <RouterLink
            to="/"
            class="font-bold text-2xl text-gray-800 hidden lg:block hover:scale-125 transition"
            >Task Manager</RouterLink
        >
        <div
            class="text-gray-800 font-bold flex items-center px-5 justify-center flex-row gap-3"
        >
            <RouterLink to="/about">ABOUT</RouterLink>
            <hr class="h-px my-8 bg-gray-200 border-1 dark:bg-gray-700" />
            <RouterLink to="/contact">CONTACT US</RouterLink>
            <hr class="h-px my-8 bg-gray-200 border-1 dark:bg-gray-700" />
            <RouterLink to="/register">REGISTER</RouterLink>
        </div>
    </header>
</template>
