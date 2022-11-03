<template>
    <div>
        <div class="md:flex md:flex-col">
            <div class="md:flex md:flex-col md:h-screen">
                <div class="md:flex md:flex-grow md:overflow-hidden">
                    <main-menu
                        class="hidden flex-shrink-0 p-12 w-56 bg-blue-800 overflow-y-auto md:block"
                    />
                    <div
                        class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto"
                        scroll-region
                    >
                        <!-- <flash-messages /> -->
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainMenu from "@/Shared/MainMenu.vue";

export default {
    components: {
        MainMenu,
    },
};
</script>
