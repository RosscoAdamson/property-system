<template>
    <div>
        <div class="mb-4">
            <Link class="group flex items-center py-3" href="/">
                <div
                    :class="
                        isUrl('')
                            ? 'text-white'
                            : 'text-blue-300 group-hover:text-white'
                    "
                >
                    Dashboard
                </div>
            </Link>
        </div>
        <div class="mb-4">
            <Link class="group flex items-center py-3" href="/properties">
                <div
                    :class="
                        isUrl('properties')
                            ? 'text-white'
                            : 'text-blue-300 group-hover:text-white'
                    "
                >
                    Properties
                </div>
            </Link>
        </div>
        <div class="mb-4">
            <Link class="group flex items-center py-3" href="/agents">
                <div
                    :class="
                        isUrl('agents')
                            ? 'text-white'
                            : 'text-blue-300 group-hover:text-white'
                    "
                >
                    Agents
                </div>
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1);
            if (urls[0] === "") {
                return currentUrl === "";
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length;
        },
    },
};
</script>
