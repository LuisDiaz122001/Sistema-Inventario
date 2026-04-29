<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { FolderTree, ArrowLeft, Save } from 'lucide-vue-next';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    location: '',
});

const submit = () => {
    form.post(route('categories.store'));
};
</script>

<template>
    <Head title="Nueva Categoría" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('categories.index')"
                    class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                >
                    <ArrowLeft class="w-5 h-5" />
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <FolderTree class="w-6 h-6 text-indigo-500" />
                    Nueva Categoría
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8 animate-fade-in-up">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <!-- Nombre -->
                            <div>
                                <InputLabel for="name" value="Nombre de la Categoría" class="text-gray-700 dark:text-gray-300" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    placeholder="Ej: Electrónicos"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <!-- Ubicación -->
                            <div>
                                <InputLabel for="location" value="Ubicación (Opcional)" class="text-gray-700 dark:text-gray-300" />
                                <TextInput
                                    id="location"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                    v-model="form.location"
                                    placeholder="Ej: Pasillo 4, Estante B"
                                />
                                <InputError class="mt-2" :message="form.errors.location" />
                            </div>

                            <div class="flex items-center justify-end pt-4 border-t border-gray-100 dark:border-gray-700 mt-8 gap-3">
                                <Link
                                    :href="route('categories.index')"
                                    class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                                >
                                    Cancelar
                                </Link>
                                <button
                                    type="submit"
                                    :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                    :disabled="form.processing"
                                    class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-600 hover:to-purple-700 focus:bg-indigo-600 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                >
                                    <Save class="w-4 h-4" />
                                    Guardar Categoría
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out;
}
</style>
