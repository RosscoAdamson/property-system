<template>
    <div>
        <Head :title="property.address + ' - Properties'" />
        <h1 class="mb-8 text-3xl font-bold" v-text="property.address" />
        <div class="grid gap-6 grid-cols-2 items-start">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Property Information
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                County
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.county"
                            />
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Country
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.country"
                            />
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Town
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.town"
                            />
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Description
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.description"
                            />
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Address
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.address"
                            />
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Latitude
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.latitude"
                            />
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Longitude
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.longitude"
                            />
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Number of Bedrooms
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.num_bedrooms"
                            />
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Number of Bathrooms
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.num_bathrooms"
                            />
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Price
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                            >
                                £{{ property.price }}
                            </dd>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Advert Type
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                            >
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800"
                                    v-if="property.type === 'sale'"
                                    >Sale</span
                                >
                                <span
                                    class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900"
                                    v-else-if="property.type === 'rent'"
                                    >Rent</span
                                >
                            </dd>
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Property Type
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                v-text="property.property_type"
                            />
                        </div>
                    </dl>
                </div>
            </div>
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div
                    class="flex items-center justify-between px-4 py-5 sm:px-6"
                >
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Agents
                    </h3>
                    <AssignAgent
                        :propertyId="property.id"
                        :unassignedAgents="unassignedAgents"
                    >
                        <template v-slot:action-button="{ open }">
                            <button
                                type="button"
                                class="bg-blue-400 hover:bg-blue-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 text-white"
                                @click="open"
                            >
                                Assign Agent
                            </button>
                        </template>
                    </AssignAgent>
                </div>
                <div class="border-t border-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-sm font-medium text-gray-500 px-6 py-4 text-left"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-medium text-gray-500 px-6 py-4 text-left"
                                >
                                    Can Conduct Viewings?
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-medium text-gray-500 px-6 py-4 text-left"
                                >
                                    Can Sell The Property?
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-medium text-gray-500 px-6 py-4 text-right"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="agent in property.agents"
                                :key="agent.id"
                            >
                                <td
                                    class="px-6 py-4 text-sm text-gray-900"
                                    v-html="agent.name"
                                />
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                                        v-if="agent.pivot.can_conduct_viewings"
                                        >Yes</span
                                    >
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                        v-else
                                        >No</span
                                    >
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                                        v-if="agent.pivot.can_sell_property"
                                        >Yes</span
                                    >
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                        v-else
                                        >No</span
                                    >
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-900 text-right flex items-center justify-end"
                                >
                                    <AssignAgent
                                        :isEdit="true"
                                        :propertyId="property.id"
                                        :unassignedAgents="agents"
                                        :agent="agent"
                                    >
                                        <template
                                            v-slot:action-button="{ open }"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                                @click="open"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-5 h-5 -ml-1 mr-3"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                                    />
                                                </svg>
                                                Edit
                                            </button>
                                        </template>
                                    </AssignAgent>
                                    <button
                                        type="button"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 ml-2"
                                        @click="detachAgent(agent)"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 -ml-1 mr-3"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>

                                        Remove
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import AssignAgent from "./Partials/AssignAgent.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Head,
        AssignAgent,
    },
    layout: AppLayout,
    props: {
        property: Object,
        agents: Object,
        unassignedAgents: Object,
    },

    methods: {
        detachAgent(agent) {
            Inertia.delete(
                `/properties/${this.property.id}/agents/${agent.id}`,
                {
                    preserveState: true,
                }
            );
        },
    },
};
</script>
