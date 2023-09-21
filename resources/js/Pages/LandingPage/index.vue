<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    landing_pages: Array,
});

const form = useForm({
    name: "",
});

const create = () => {
    form.post(route("landing-page.store"), {
        onSuccess: () => form.reset(),
    });
};
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

                <div class="w-auto drawer">
                    <button
                        class="btn btn-primary"
                        onclick="modal_landingpage_create.showModal()"
                    >
                        Criar
                    </button>

                    <dialog id="modal_landingpage_create" class="modal">
                        <div class="modal-box">
                            <form @submit.prevent="create">
                                <div class="flex flex-col gap-3">
                                    <input
                                        type="text"
                                        placeholder="Digite um nome para a página..."
                                        class="w-full input input-bordered"
                                        v-model="form.name"
                                    />

                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                    >
                                        Salvar
                                    </button>
                                </div>
                            </form>
                        </div>

                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg -z-10"
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
                                            :href="
                                                route(
                                                    'landing-page.edit',
                                                    landing_page.id
                                                )
                                            "
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
