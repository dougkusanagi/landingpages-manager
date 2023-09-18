<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    landing_pages: Array,
});
</script>

<template>
    <Head title="Clone Website" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Landing Pages
                </h2>

                <div class="drawer">
                    <input
                        id="my-drawer"
                        type="checkbox"
                        class="drawer-toggle"
                    />

                    <div class="drawer-content">
                        <!-- Page content here -->
                        <label
                            for="my-drawer"
                            class="btn btn-primary drawer-button"
                        >
                            Criar
                        </label>
                    </div>

                    <Teleport to="body">
                        <div class="drawer-side">
                            <label for="my-drawer" class="drawer-overlay">
                            </label>
                            <ul
                                class="min-h-full p-4 menu w-80 bg-base-200 text-base-content"
                            >
                                <!-- Sidebar content here -->
                                <li>
                                    <a>Sidebar Item 1</a>
                                </li>
                                <li>
                                    <a>Sidebar Item 2</a>
                                </li>
                            </ul>
                        </div>
                    </Teleport>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- row 1 -->
                                <tr v-for="landing_page in landing_pages">
                                    <th>
                                        {{ landing_page.id }}
                                    </th>

                                    <td>
                                        <a
                                            href="#"
                                            class="link link-accent link-hover"
                                        >
                                            {{ landing_page.name }}
                                        </a>
                                    </td>

                                    <td class="flex gap-3">
                                        <a
                                            :href="
                                                route(
                                                    'landing-page-builder',
                                                    landing_page.id
                                                )
                                            "
                                            target="_blank"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Construtor
                                        </a>

                                        <a
                                            href="#"
                                            class="btn btn-accent btn-outline btn-sm"
                                        >
                                            Upload FTP
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
