<template>
    <DialogModal :canClose="canClose" @submit="submit" @close="close">
        <template v-slot:title>Assign Agent</template>
        <template v-slot:content>
            <form class="space-y-6">
                <div>
                    <label
                        for="agent"
                        class="block text-sm font-medium text-gray-700"
                        >Agent *</label
                    >
                    <div class="mt-1">
                        <select
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm"
                            v-model="form.id"
                            :disabled="isEdit"
                        >
                            <option
                                v-for="agent in unassignedAgents"
                                :key="agent.id"
                                :value="agent.id"
                                v-text="agent.name"
                            />
                        </select>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                        <input
                            v-model="form.can_conduct_viewings"
                            id="can_conduct_viewings"
                            name="can_conduct_viewings"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="ml-3 text-sm">
                        <label
                            for="can_conduct_viewings"
                            class="font-medium text-gray-700"
                            >Can Conduct Viewings?</label
                        >
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                        <input
                            v-model="form.can_sell_property"
                            id="can_sell_property"
                            name="can_sell_property"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="ml-3 text-sm">
                        <label
                            for="can_sell_property"
                            class="font-medium text-gray-700"
                            >Can Sell This Property?</label
                        >
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

export default {
    setup(props) {
        let fields = {
            id: null,
            can_conduct_viewings: false,
            can_sell_property: false,
        };

        if (props.isEdit && props.agent) {
            fields.id = props.agent.id;
            fields.can_conduct_viewings =
                props.agent.pivot.can_conduct_viewings;
            fields.can_sell_property = props.agent.pivot.can_sell_property;
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
        propertyId: {
            type: Number,
            required: true,
        },
        unassignedAgents: {
            type: Object,
            required: true,
        },
        agent: {
            type: Object,
            required: false,
        },
    },

    methods: {
        submit() {
            const url = this.isEdit
                ? `/properties/${this.propertyId}/agents/${this.agent.id}`
                : `/properties/${this.propertyId}/agents`;

            this.form.clearErrors();
            this.form.post(url, {
                onSuccess: () => {
                    Inertia.get(`/properties/${this.propertyId}`, null, {
                        preserveState: true,
                    });
                },
            });
        },

        close() {
            this.form.reset();
            this.form.clearErrors();
        },
    },
};
</script>
