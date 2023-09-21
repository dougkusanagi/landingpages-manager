<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    landing_page: Object,
});

const form = useForm({
    name: props.landing_page.name,
    seo_title: props.landing_page.seo_title,
    seo_description: props.landing_page.seo_description,
    seo_keywords: props.landing_page.seo_keywords,
});

const update = () => {
    form.put(route("landing-page.update", props.landing_page.id));
};

onMounted(() => {
    console.log(props.landing_page);
});
</script>

<template>
    <Head title="Clone Website" />

    <AuthenticatedLayout>
        <template #header class="sticky top-0">
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-8 text-gray-800 dark:text-gray-200"
                >
                    <Link
                        :href="route('landing-page.index')"
                        :active="route().current('landing-page.index')"
                    >
                        Landing Pages
                    </Link>

                    <span
                        class="leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent dark:text-gray-400"
                    >
                        / Criar
                    </span>
                </h2>

                <button
                    class="btn btn-primary"
                    type="submit"
                    form="update-form"
                >
                    Salvar
                </button>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="update" id="update-form">
                    <div class="flex flex-col gap-6">
                        <div
                            class="grid grid-cols-1 gap-4 p-6 text-sm bg-white shadow-sm gap-y-2 lg:grid-cols-3 dark:bg-gray-800 sm:rounded-lg"
                        >
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">
                                    Informações Básicas
                                </p>

                                <p>Favor preencha todos os campos.</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div
                                    class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5"
                                >
                                    <div class="md:col-span-5">
                                        <label for="name">Nome</label>

                                        <input
                                            id="name"
                                            type="text"
                                            placeholder="Ex: Teste"
                                            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50 input input-bordered"
                                            v-model="form.name"
                                            required
                                            autofocus
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-4 p-6 text-sm bg-white shadow-sm gap-y-2 lg:grid-cols-3 dark:bg-gray-800 sm:rounded-lg"
                        >
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">
                                    Otimizações para SEO
                                </p>

                                <p>
                                    Informações pertinentes aos motores de
                                    busca.
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <div
                                    class="grid grid-cols-1 gap-4 text-sm gap-y-4 md:grid-cols-5"
                                >
                                    <div class="md:col-span-5">
                                        <label for="seo_title" class="label">
                                            <span class="label-text">
                                                Título
                                            </span>
                                        </label>

                                        <input
                                            id="seo_title"
                                            type="text"
                                            class="w-full h-10 px-4 border rounded bg-gray-50 input input-bordered"
                                            v-model="form.seo_title"
                                        />

                                        <label class="label">
                                            <span class="label-text-alt">
                                                Recomendado entre 50-70
                                                caracteres
                                            </span>
                                        </label>
                                    </div>

                                    <div class="md:col-span-5">
                                        <div class="w-full form-control">
                                            <label
                                                for="seo_description"
                                                class="label"
                                            >
                                                <span class="label-text">
                                                    Descrição
                                                </span>
                                            </label>

                                            <textarea
                                                id="seo_description"
                                                class="w-full px-4 border rounded bg-gray-50 textarea textarea-bordered"
                                                v-model="form.seo_description"
                                                rows="3"
                                            />

                                            <label class="label">
                                                <span class="label-text-alt">
                                                    Recomendado entre 150-160
                                                    caracteres
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="md:col-span-5">
                                        <div class="w-full form-control">
                                            <label
                                                for="seo_keywords"
                                                class="label"
                                            >
                                                <span class="label-text">
                                                    Palavras-chave
                                                </span>
                                            </label>

                                            <textarea
                                                id="seo_keywords"
                                                class="w-full px-4 border rounded bg-gray-50 textarea textarea-bordered"
                                                v-model="form.seo_keywords"
                                                rows="3"
                                            />

                                            <label class="label">
                                                <span class="label-text-alt">
                                                    Recomendado entre 160-165
                                                    caracteres
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
