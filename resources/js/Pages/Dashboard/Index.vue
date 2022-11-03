<template>
    <div>
        <Head title="Dashboard" />
        <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
        <p class="mb-8 leading-normal">
            Hey there! Welcome to the Property System, a demo app by Ross
            Adamson.
        </p>
    </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
    components: {
        Head,
    },
    layout: AppLayout,
};
</script>
