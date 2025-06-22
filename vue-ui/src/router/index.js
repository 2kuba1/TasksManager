import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import About from "../pages/About.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Dashboard from "../pages/Dashboard.vue";
import Contact from "../pages/Contact.vue";

const routes = [
    { path: "/", name: "Home", component: Home },
    { path: "/about", name: "About", component: About },
    { path: "/login/:success?", name: "Login", component: Login },
    { path: "/register", name: "Register", component: Register },
    { path: "/dashboard/:id", name: "Dashboard", component: Dashboard },
    { path: "/contact", name: "Contact", component: Contact },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
