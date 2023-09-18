<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "Teste1",
});

const create = () => {
    form.post(route("landing-page.store"));
};
</script>

<template>
    <Head title="Clone Website" />

    <AuthenticatedLayout>
        <template #header>
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
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <form @submit.prevent="create">
                        <div
                            class="flex gap-3 text-gray-900 dark:text-gray-100"
                        >
                            <input
                                type="text"
                                placeholder="Digite um nome para a página..."
                                class="w-full input input-bordered"
                                v-model="form.name"
                            />

                            <button class="btn btn-primary" type="submit">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
