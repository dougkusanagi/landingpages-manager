<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import vueFilePond, { setOptions } from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond/dist/filepond.min.css";

const props = defineProps({
    landing_page: Object,
});

const filepond_ref = ref();

const form = useForm({
    name: props.landing_page.name,
    seo_title: props.landing_page.seo_title,
    seo_description: props.landing_page.seo_description,
    seo_keywords: props.landing_page.seo_keywords,
    social_title: props.landing_page.social_title,
    social_description: props.landing_page.social_description,
    social_keywords: props.landing_page.social_keywords,
    social_image: props.landing_page.social_image,
    ftp_host: props.landing_page.ftp_host,
    ftp_port: props.landing_page.ftp_port,
    ftp_user: props.landing_page.ftp_user,
    ftp_password: props.landing_page.ftp_password,
    ftp_path: props.landing_page.ftp_path,
});

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const handleFilePondInit = () => {
    setOptions({
        credits: false,
        disabled: true,
        server: {
            url: "/filepond",
            headers: { "X-CSRF-TOKEN": usePage().props.csrf_token },
        },
        maxParallelUploads: 5, // default is 2
        labelInvalidField: "Somente jpg, png ou webp são permitidos",
        // storeAsFile: false,
        // allowReorder: true,
        // onreorderfiles(files, origin, target) {
        //     form.social_image = [];

        //     files.forEach((file) =>
        //         form.social_image.push({
        //             id: file.id,
        //             serverId: file.serverId,
        //             filename: file.filename,
        //         })
        //     );
        // },
    });
};

const handleFilePondProcess = function (error, file) {
    form.social_image.push({
        id: file.id,
        serverId: file.serverId,
        filename: file.filename,
    });
};

const handleFilePondRemoveFile = function (error, file) {
    form.social_image.value = form.social_image.filter(
        (item) => item.id !== file.id
    );
};

const updateLandingPage = () => {
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
                <form @submit.prevent="updateLandingPage" id="update-form">
                    <div class="flex flex-col gap-6">
                        <div
                            class="grid grid-cols-1 gap-4 p-6 text-sm bg-white shadow-sm gap-y-2 lg:grid-cols-3 dark:bg-gray-800 sm:rounded-lg"
                        >
                            <div class="text-gray-600 dark:text-gray-400">
                                <h3 class="text-lg font-medium">
                                    Informações Básicas
                                </h3>

                                <p>Todas são obrigatórias</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div
                                    class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5"
                                >
                                    <div class="md:col-span-5">
                                        <label for="name" class="label">
                                            <span class="label-text">
                                                Nome
                                            </span>
                                        </label>

                                        <input
                                            id="name"
                                            type="text"
                                            placeholder="Ex: Teste"
                                            class="w-full h-10 input input-bordered"
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
                                <h3 class="text-lg font-medium">
                                    Otimizações para SEO
                                </h3>

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
                                            class="w-full h-10 input input-bordered"
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
                                                class="w-full textarea textarea-bordered"
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
                                                class="w-full textarea textarea-bordered"
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
                            <div
                                class="flex flex-col gap-6 text-gray-600 dark:text-gray-400"
                            >
                                <div>
                                    <h3 class="text-lg font-medium">
                                        Otimização de Social Links
                                    </h3>

                                    <p>
                                        Informações pertinentes aos links de
                                        redes sociais
                                    </p>
                                </div>

                                <div>
                                    <label for="social_title" class="label">
                                        <span class="label-text">
                                            Miniatura
                                        </span>
                                    </label>

                                    <file-pond
                                        class="mb-0"
                                        ref="filepond_ref"
                                        @init="handleFilePondInit"
                                        @processfile="handleFilePondProcess"
                                        @removefile="handleFilePondRemoveFile"
                                    />

                                    <label class="label">
                                        <span class="label-text-alt">
                                            Miniatura que acompanha o link
                                            compartilhado na rede social
                                        </span>
                                    </label>
                                </div>
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
                                            class="w-full h-10 input input-bordered"
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
                                                class="w-full textarea textarea-bordered"
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
                                                class="w-full textarea textarea-bordered"
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
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-4 p-6 text-sm bg-white shadow-sm gap-y-2 lg:grid-cols-3 dark:bg-gray-800 sm:rounded-lg"
                        >
                            <div class="text-gray-600 dark:text-gray-400">
                                <h3 class="text-lg font-medium">
                                    Configurações FTP
                                </h3>

                                <p>
                                    Informações para enviar os arquivos para o
                                    servidor
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <div
                                    class="grid grid-cols-1 gap-4 text-sm gap-y-4 md:grid-cols-6"
                                >
                                    <div class="md:col-span-4">
                                        <label for="ftp_host" class="label">
                                            <span class="label-text">
                                                Host
                                            </span>
                                            <span class="label-text-alt">
                                                Endereço do servidor
                                            </span>
                                        </label>

                                        <input
                                            id="ftp_host"
                                            type="text"
                                            class="w-full h-10 input input-bordered"
                                            v-model="form.ftp_host"
                                        />
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="ftp_port" class="label">
                                            <span class="label-text">
                                                Porta
                                            </span>
                                        </label>

                                        <input
                                            id="ftp_port"
                                            type="text"
                                            class="w-full h-10 input input-bordered"
                                            v-model="form.ftp_port"
                                        />
                                    </div>

                                    <div class="md:col-span-3">
                                        <label for="ftp_user" class="label">
                                            <span class="label-text">
                                                Usuário
                                            </span>
                                        </label>

                                        <input
                                            id="ftp_user"
                                            type="text"
                                            class="w-full h-10 input input-bordered"
                                            v-model="form.ftp_user"
                                        />
                                    </div>

                                    <div class="md:col-span-3">
                                        <label for="ftp_password" class="label">
                                            <span class="label-text">
                                                Senha
                                            </span>
                                        </label>

                                        <input
                                            id="ftp_password"
                                            type="text"
                                            class="w-full h-10 input input-bordered"
                                            v-model="form.ftp_password"
                                        />
                                    </div>

                                    <div class="md:col-span-6">
                                        <label for="ftp_path" class="label">
                                            <span class="label-text">
                                                Caminho
                                            </span>
                                        </label>

                                        <input
                                            id="ftp_path"
                                            type="text"
                                            class="w-full h-10 input input-bordered"
                                            v-model="form.ftp_path"
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

<style>
.filepond--root {
    margin-bottom: 0 !important;
}
</style>
