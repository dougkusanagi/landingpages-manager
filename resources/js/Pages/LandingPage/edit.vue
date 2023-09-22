<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import vueFilePond, { setOptions } from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond/dist/filepond.min.css";

const props = defineProps({
    landing_page: Object,
});

const form = useForm({
    name: props.landing_page.name,
    seo_title: props.landing_page.seo_title,
    seo_description: props.landing_page.seo_description,
    seo_keywords: props.landing_page.seo_keywords,
    social_title: props.landing_page.social_title,
    social_description: props.landing_page.social_description,
    social_keywords: props.landing_page.social_keywords,
    social_image: props.landing_page.social_image,
});

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const handleFilepondInit = () => {
    filepond.setOptions({
        server: {
            url: "/upload",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        },
    });
};

const handleFilepondLoad = () => {};

const update = () => {
    form.put(route("landing-page.update", props.landing_page.id), {
        preserveScroll: true,
        preserveState: true,
        // forceFormData: true,
    });
};
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
                    class="btn btn-primary btn-sm"
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
                            <div class="text-gray-600 dark:text-gray-400">
                                <p class="text-lg font-medium">
                                    Informações Básicas
                                </p>

                                <p>Todas são obrigatórias</p>
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
                            <div class="text-gray-600 dark:text-gray-400">
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
                                                rows="2"
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
                                                rows="2"
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

                        <div
                            class="grid grid-cols-1 gap-4 p-6 text-sm bg-white shadow-sm gap-y-2 lg:grid-cols-3 dark:bg-gray-800 sm:rounded-lg"
                        >
                            <div class="text-gray-600 dark:text-gray-400">
                                <p class="text-lg font-medium">
                                    Otimização de Social Links
                                </p>

                                <p>
                                    Informações pertinentes aos links de redes
                                    sociais
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <div
                                    class="grid grid-cols-1 gap-4 text-sm gap-y-4 md:grid-cols-5"
                                >
                                    <div class="md:col-span-5">
                                        <label for="social_title" class="label">
                                            <span class="label-text">
                                                Título
                                            </span>
                                        </label>

                                        <input
                                            id="social_title"
                                            type="text"
                                            class="w-full h-10 px-4 border rounded bg-gray-50 input input-bordered"
                                            v-model="form.social_title"
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
                                                for="social_description"
                                                class="label"
                                            >
                                                <span class="label-text">
                                                    Descrição
                                                </span>
                                            </label>

                                            <textarea
                                                id="social_description"
                                                class="w-full px-4 border rounded bg-gray-50 textarea textarea-bordered"
                                                v-model="
                                                    form.social_description
                                                "
                                                rows="2"
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
                                                for="social_keywords"
                                                class="label"
                                            >
                                                <span class="label-text">
                                                    Palavras-chave
                                                </span>
                                            </label>

                                            <textarea
                                                id="social_keywords"
                                                class="w-full px-4 border rounded bg-gray-50 textarea textarea-bordered"
                                                v-model="form.social_keywords"
                                                rows="2"
                                            />

                                            <label class="label">
                                                <span class="label-text-alt">
                                                    Recomendado entre 160-165
                                                    caracteres
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="social_title" class="label">
                                            <span class="label-text">
                                                Miniatura
                                            </span>
                                        </label>

                                        <label class="label">
                                            <span class="label-text-alt">
                                                Miniatura que acompanha o link
                                                compartilhado na rede social
                                            </span>
                                        </label>

                                        <file-pond
                                            name="social_image"
                                            accepted-file-types="image/jpeg, image/png, image/webp"
                                            :allow-multiple="false"
                                            :files="form.social_image"
                                            :init="handleFilepondInit"
                                            :server="{
                                                url: '',
                                                timeout: 7000,
                                                proccess: {
                                                    url: 'upload-landingpage-social-image',
                                                    method: 'POST',
                                                    onload: handleFilepondLoad,
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN':
                                                        $page.props.csrf_token,
                                                },
                                            }"
                                        />
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
