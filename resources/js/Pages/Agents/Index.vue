<template>
    <div>
        <Head title="Agents" />
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold">Agents</h1>
            <AgentModal>
                <template v-slot:action-button="{ open }">
                    <button
                        type="button"
                        class="bg-blue-400 hover:bg-blue-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 text-white"
                        @click="open"
                    >
                        Add New Agent
                    </button>
                </template>
            </AgentModal>
        </div>
        <div class="flex flex-col" v-if="agents.length > 0">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th
                                        scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                                    >
                                        Phone Numbers
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                                    >
                                        Email
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                                    >
                                        Address
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-right"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                                    v-for="agent in agents"
                                    :key="agent.id"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                        v-text="agent.name"
                                    />
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                    >
                                        {{ agent.phone_numbers.join(", ") }}
                                    </td>
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                        v-text="agent.email"
                                    />
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                        v-text="agent.address"
                                    />
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 text-right whitespace-nowrap"
                                    >
                                        <AgentModal
                                            :isEdit="true"
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
                                        </AgentModal>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import AgentModal from "./Partials/AgentModal.vue";

export default {
    components: {
        Head,
        AgentModal,
    },
    layout: AppLayout,
    props: {
        agents: Object,
    },
};
</script>
