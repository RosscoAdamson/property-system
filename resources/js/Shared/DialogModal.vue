<template>
    <div>
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="close" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full grid grid-cols-1 divide-y max-w-md transform overflow-hidden rounded-2xl bg-white py-5 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-900 px-6"
                                >
                                    <slot name="title" />
                                </DialogTitle>
                                <div class="mt-4 px-6 py-3">
                                    <slot name="content" />
                                </div>
                                <div
                                    class="flex items-center justify-between mt-4 px-6 pt-4"
                                >
                                    <button
                                        type="button"
                                        class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300"
                                        @click="close"
                                    >
                                        Close
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                        :class="{
                                            'hover:bg-blue-100': processing,
                                            'text-blue-500': processing,
                                            'cursor-not-allowed': processing,
                                        }"
                                        :disabled="processing"
                                        @click="$emit('submit')"
                                    >
                                        <svg
                                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            v-if="processing"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        <slot name="button-text" />
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <slot name="action-button" :open="open" />
    </div>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
} from "@headlessui/vue";

export default {
    props: {
        canClose: {
            type: Boolean,
            default: true,
        },
        processing: {
            type: Boolean,
            default: false,
        },
    },

    data() {
        return {
            isOpen: false,
        };
    },

    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        DialogDescription,
    },

    methods: {
        open() {
            this.isOpen = true;
        },

        close() {
            this.isOpen = false;
            this.$emit("close");
        },
    },
};
</script>
