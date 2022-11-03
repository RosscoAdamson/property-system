<template>
    <div class="flex w-full lg:w-1/3 px-0 py-4 lg:p-4">
        <div class="relative flex flex-1 p-2">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg transform rounded-md"
            ></div>
            <div class="relative flex flex-col bg-white p-4 rounded-md w-full">
                <div
                    class="relative w-full max-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden"
                >
                    <img
                        :src="property.image_thumbnail"
                        class="w-full h-50 lg:h-80 max-h-80 object-center object-cover"
                    />
                </div>
                <div class="mt-4 mb-4 flex flex-1 justify-between">
                    <div>
                        <h3
                            class="text-sm text-gray-700"
                            v-text="property.address"
                        />
                        <p class="mt-1 text-sm text-gray-500">
                            {{ property.town }}, {{ property.county }}
                        </p>
                        <p
                            class="mt-1 text-sm text-gray-500"
                            v-text="property.country"
                        />
                    </div>
                    <p class="text-sm font-medium text-gray-900 ml-5">
                        £{{ property.price }}
                    </p>
                </div>
                <div class="flex items-center justify-end">
                    <Link
                        class="bg-blue-400 hover:bg-blue-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 text-white"
                        :href="propertyLink"
                    >
                        View Property
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: {
        property: Object,
    },

    computed: {
        propertyLink() {
            return `/properties/${this.property.id}`;
        },
    },
};
</script>
