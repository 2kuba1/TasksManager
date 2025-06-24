<script setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";
import getCookie from "../utils/getCookie";
import axios from "axios";
import { useRouter } from "vue-router";

const loggedRef = ref(getCookie("token") ? true : false);
const router = useRouter();
const tasksPageRedirectUrl = "/dashboard/" + localStorage.getItem("id");

async function handleLogout() {
    try {
        await axios.post(
            `${import.meta.env.VITE_API_ENDPOINT}/api/v1/users/logout`,
            null,
            {
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${getCookie("token")}`,
                },
            }
        );

        document.cookie =
            "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        localStorage.clear();
        router.push("/");
    } catch (error) {
        console.log("An error occured while logging out");
    }
}
</script>

<template>
    <nav
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
            <RouterLink
                class="hover:scale-110 transition"
                v-if="loggedRef"
                :to="tasksPageRedirectUrl"
                >TASKS</RouterLink
            >
            <hr
                v-if="loggedRef"
                class="h-px my-8 bg-gray-200 border-1 dark:bg-gray-700"
            />

            <RouterLink class="hover:scale-110 transition" to="/about"
                >ABOUT</RouterLink
            >
            <hr class="h-px my-8 bg-gray-200 border-1 dark:bg-gray-700" />
            <RouterLink class="hover:scale-110 transition" to="/contact"
                >CONTACT US</RouterLink
            >
            <hr class="h-px my-8 bg-gray-200 border-1 dark:bg-gray-700" />
            <RouterLink
                class="hover:scale-110 transition"
                v-if="!loggedRef"
                to="/register"
                >REGISTER</RouterLink
            >
            <span
                @click="handleLogout"
                v-if="loggedRef"
                class="cursor-pointer hover:scale-110 transition"
                >LOGOUT</span
            >
        </div>
    </nav>
</template>
