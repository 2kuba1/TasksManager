<script setup>
import { RouterLink } from "vue-router";
import AppBar from "../components/AppBar.vue";
import getCookie from "../utils/getCookie";
import { useRouter } from "vue-router";

const router = useRouter();

const isLogged = getCookie("token") ? true : false;

const redirect = isLogged
    ? `/dashboard/${localStorage.getItem("id")}`
    : "/login";

const redirectText = isLogged ? "Tasks" : "Login";

function logout() {
    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    localStorage.clear();
    router.push({ path: "/login" });
}
</script>

<template>
    <AppBar />
    <main
        class="h-[calc(100vh-4rem)] flex flex-row items-center justify-center gap-5 font-primary"
    >
        <RouterLink
            :to="redirect"
            class="h-14 w-24 text-white bg-orange-500 rounded-2xl hover:scale-125 transition flex items-center justify-center"
        >
            {{ redirectText }}
        </RouterLink>

        <RouterLink
            v-if="!isLogged"
            to="/register"
            class="h-14 w-24 border-2 border-orange-500 text-orange-500 rounded-2xl hover:scale-125 transition flex items-center justify-center"
        >
            Register
        </RouterLink>
        <button
            v-else
            @click="logout"
            class="h-14 w-24 border-2 border-orange-500 text-orange-500 rounded-2xl hover:scale-125 transition flex items-center justify-center cursor-pointer"
        >
            Logout
        </button>
    </main>
</template>
