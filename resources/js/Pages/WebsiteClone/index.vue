<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    cloned_landing_pages: Array,
});

const form = useForm({ url: "meuzeushair.com.br" });

async function clone() {
    form.post(route("website.clone"));
}
</script>

<template>
    <Head title="Clone Website" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Clone de Páginas
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <form @submit.prevent="clone">
                        <div class="p-6">
                            <div
                                class="flex gap-3 text-gray-900 dark:text-gray-100"
                            >
                                <input
                                    type="text"
                                    v-model="form.url"
                                    placeholder="ex: meuzeushair.com.br"
                                    class="w-full input input-bordered"
                                />
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                    :disabled="form.processing"
                                >
                                    Clone
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div
                    v-for="landing_page in cloned_landing_pages"
                    class="flex items-center gap-6 px-6 py-4 mt-4 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <a
                        class="flex-1 overflow-hidden link link-accent text-ellipsis whitespace-nowrap"
                        :href="landing_page.url"
                    >
                        {{ landing_page.url }}
                    </a>

                    <div class="flex flex-col">
                        <span>Criado em: {{ landing_page.created_at }}</span>
                        <span>Editado em: {{ landing_page.updated_at }}</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            class="btn btn-accent btn-sm"
                            target="_blank"
                            :href="'cloned-landingpages/' + landing_page.id"
                        >
                            Ver Baixado
                        </a>

                        <a class="btn btn-outline btn-accent btn-sm" href="#">
                            Editar
                        </a>

                        <a class="link link-error" href="#">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
