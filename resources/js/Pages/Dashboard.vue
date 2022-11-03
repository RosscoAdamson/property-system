<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <div>
        <Head title="Dashboard" />
        <nav class="fixed w-full bg-blue-100 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <Link class="flex items-center text-lg font-medium"
                                >Property System</Link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="max-w-2xl mx-auto py-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="flex w-full lg:w-1/3 px-0 py-4 lg:p-4">
                <div class="relative flex flex-1 p-2">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-cyan-300 to-pink-300 shadow-lg transform rounded-md"
                    ></div>
                    <div
                        class="relative flex flex-col bg-white p-4 rounded-md w-full"
                    >
                        <div
                            class="relative w-full max-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden"
                        >
                            <img
                                src="https://p-hold.com/100/100?54016"
                                class="w-full h-50 lg:h-80 max-h-80 object-center object-contain"
                            />
                        </div>
                        <div
                            class="mt-4 flex flex-1 justify-between"
                            :class="{ 'mb-4': !purchased }"
                        >
                            <div>
                                <h3 class="text-sm text-gray-700">Cupar</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    8 Beech Bank
                                </p>
                            </div>
                            <p class="text-sm font-medium text-gray-900 ml-5">
                                £250,000
                            </p>
                        </div>
                        <div class="flex items-center justify-end">
                            <button
                                class="bg-pink-300 hover:bg-pink-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300"
                            >
                                I've Bought This!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
