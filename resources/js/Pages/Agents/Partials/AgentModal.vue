<template>
    <DialogModal
        :processing="form.processing"
        :canClose="canClose"
        @submit="submit"
        @close="close"
    >
        <template v-slot:title>{{ isEdit ? "Edit" : "Create" }} Agent</template>
        <template v-slot:content>
            <form class="space-y-6">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        :class="{
                            'text-red-500': form.errors.name,
                        }"
                        >Name *</label
                    >
                    <div class="mt-1">
                        <input
                            type="text"
                            v-model="form.name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm"
                            :class="{
                                'text-red-700': form.errors.name,
                                'border-red-400': form.errors.name,
                                'bg-red-50': form.errors.name,
                                'focus:border-red-400': form.errors.name,
                                'focus:ring-red-400': form.errors.name,
                            }"
                        />
                        <div
                            v-if="form.errors.name"
                            class="mt-1 text-red-500 text-xs"
                        >
                            {{ form.errors.name }}
                        </div>
                    </div>
                </div>
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                        :class="{
                            'text-red-500': form.errors.email,
                        }"
                        >Email *</label
                    >
                    <div class="mt-1">
                        <input
                            type="email"
                            v-model="form.email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm"
                            :class="{
                                'text-red-700': form.errors.email,
                                'border-red-400': form.errors.email,
                                'bg-red-50': form.errors.email,
                                'focus:border-red-400': form.errors.email,
                                'focus:ring-red-400': form.errors.email,
                            }"
                        />
                        <div
                            v-if="form.errors.email"
                            class="mt-1 text-red-500 text-xs"
                        >
                            {{ form.errors.email }}
                        </div>
                    </div>
                </div>
                <div>
                    <label
                        for="address"
                        class="block text-sm font-medium text-gray-700"
                        :class="{
                            'text-red-500': form.errors.address,
                        }"
                        >Address *</label
                    >
                    <div class="mt-1">
                        <input
                            type="text"
                            v-model="form.address"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm"
                            :class="{
                                'text-red-700': form.errors.address,
                                'border-red-400': form.errors.address,
                                'bg-red-50': form.errors.address,
                                'focus:border-red-400': form.errors.address,
                                'focus:ring-red-400': form.errors.address,
                            }"
                        />
                        <div
                            v-if="form.errors.address"
                            class="mt-1 text-red-500 text-xs"
                        >
                            {{ form.errors.address }}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-end justify-between">
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700"
                            :class="{
                                'text-red-500': form.errors.phone,
                            }"
                            >Phone Number *</label
                        >
                        <button
                            type="button"
                            class="p-2 mt-1 bg-green-100 text-green-800 rounded-full"
                            @click="addPhoneNumber"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>
                        </button>
                    </div>
                    <div
                        class="mt-1 flex items-center"
                        v-for="(number, index) in form.phone_numbers"
                        :key="index"
                    >
                        <div class="grow">
                            <input
                                type="tel"
                                v-model="form.phone_numbers[index]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm"
                                :class="{
                                    'text-red-700': form.errors.phone_numbers,
                                    'border-red-400': form.errors.phone_numbers,
                                    'bg-red-50': form.errors.phone_numbers,
                                    'focus:border-red-400':
                                        form.errors.phone_numbers,
                                    'focus:ring-red-400':
                                        form.errors.phone_numbers,
                                }"
                            />
                            <div
                                v-if="form.errors.phone"
                                class="mt-1 text-red-500 text-xs"
                            >
                                {{ form.errors.phone }}
                            </div>
                        </div>
                        <button
                            type="button"
                            class="p-2 mt-1 ml-2 bg-red-100 text-red-800 rounded-full shrink-0"
                            @click="removePhoneNumber(number)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-4 h-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 12h-15"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:button-text>Save</template>
        <template v-slot:action-button="{ open }">
            <slot name="action-button" :open="open" />
        </template>
    </DialogModal>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DialogModal from "@/Shared/DialogModal.vue";
import { cloneDeep, remove } from "lodash";

export default {
    setup(props) {
        let fields = {
            name: null,
            email: null,
            address: null,
            phone_numbers: [""],
        };

        if (props.isEdit && props.agent) {
            fields.name = props.agent.name;
            fields.email = props.agent.email;
            fields.address = props.agent.address;
            fields.phone_numbers = props.agent.phone_numbers;
        }

        const form = useForm(fields);

        return { form };
    },

    components: {
        DialogModal,
    },

    props: {
        canClose: {
            type: Boolean,
            default: true,
        },
        isEdit: {
            type: Boolean,
            default: false,
        },
        agent: {
            type: Object,
            required: false,
        },
    },

    methods: {
        submit() {
            let url = this.isEdit ? `/agents/${this.agent.id}` : "/agents";

            this.form.clearErrors();
            this.form.post(url, {
                onSuccess: () => {
                    Inertia.get("/agents", null, {
                        preserveState: true,
                    });
                },
            });
        },

        close() {
            this.form.reset();
            this.form.clearErrors();
        },

        addPhoneNumber() {
            this.form.phone_numbers.push("");
        },

        removePhoneNumber(number) {
            let phoneNumbers = cloneDeep(this.form.phone_numbers);

            this.form.phone_numbers = remove(phoneNumbers, function (n) {
                return n != number;
            });
        },
    },
};
</script>
