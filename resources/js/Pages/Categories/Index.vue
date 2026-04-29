<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { FolderTree, Plus, Edit, Trash2, MapPin, Search } from 'lucide-vue-next';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import { debounce } from 'lodash-es';

const props = defineProps({
    categories: Object,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters?.search || '');

watch(search, debounce((value) => {
    router.get(route('categories.index'), { search: value }, { preserveState: true, replace: true });
}, 300));

const deleteCategory = (id) => {
    if (confirm('¿Estás seguro de que quieres eliminar esta categoría?')) {
        form.delete(route('categories.destroy', id));
    }
};
</script>

<template>
    <Head title="Categorías" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <FolderTree class="w-6 h-6 text-indigo-500" />
                    Categorías
                </h2>
                
                <div class="flex items-center gap-4">
                    <!-- Buscador -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <Search class="h-4 w-4 text-gray-400" />
                        </div>
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Buscar categoría..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                        />
                    </div>

                    <Link
                        :href="route('categories.create')"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 focus:bg-indigo-600 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 whitespace-nowrap"
                    >
                        <Plus class="w-4 h-4" />
                        Nueva Categoría
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.message" class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 flex items-center gap-3 animate-fade-in-down">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    {{ $page.props.flash.message }}
                </div>

                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">ID</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">Nombre</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">Ubicación</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-center">Productos</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr 
                                    v-for="category in categories.data" 
                                    :key="category.id"
                                    class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors duration-200 group"
                                >
                                    <td class="py-4 px-6 text-gray-500 dark:text-gray-400">#{{ category.id }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-900 dark:text-gray-100">{{ category.name }}</td>
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-300">
                                        <div class="flex items-center gap-1.5" v-if="category.location">
                                            <MapPin class="w-4 h-4 text-gray-400 group-hover:text-indigo-400 transition-colors" />
                                            {{ category.location }}
                                        </div>
                                        <span v-else class="text-gray-400 italic">No especificada</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center justify-center min-w-[2.5rem] px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                            {{ category.products_count }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-3 opacity-70 group-hover:opacity-100 transition-opacity">
                                            <Link 
                                                :href="route('categories.edit', category.id)"
                                                class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors p-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/30"
                                                title="Editar"
                                            >
                                                <Edit class="w-5 h-5" />
                                            </Link>
                                            <button 
                                                @click="deleteCategory(category.id)"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30"
                                                title="Eliminar"
                                            >
                                                <Trash2 class="w-5 h-5" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="categories.data.length === 0">
                                    <td colspan="5" class="py-12 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="p-4 rounded-full bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                                                <FolderTree class="w-8 h-8 text-gray-400" />
                                            </div>
                                            <p>No hay categorías registradas o que coincidan con la búsqueda.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <Pagination :links="categories.links" class="mt-8" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
@keyframes fade-in-down {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fade-in-down 0.4s ease-out;
}
</style>
