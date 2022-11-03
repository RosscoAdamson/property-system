<template>
    <div>
        <Head title="Properties" />
        <h1 class="mb-8 text-3xl font-bold">Properties</h1>
        <div
            class="mt-6 mr-0 ml-0 xl:-mr-4 xl:-ml-4 flex flex-wrap"
            v-if="properties.length > 0"
        >
            <property-card
                v-for="property in properties"
                :key="property.id"
                :property="property"
            />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PropertyCard from "./Partials/PropertyCard.vue";

export default {
    components: {
        Head,
        PropertyCard,
    },
    layout: AppLayout,
    props: {
        properties: Object,
    },
};
</script>
