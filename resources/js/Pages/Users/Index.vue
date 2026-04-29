<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { Users, Plus, Edit, Trash2, Search, Shield, ShieldCheck } from 'lucide-vue-next';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import { debounce } from 'lodash-es';

const props = defineProps({
    users: Object,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters?.search || '');

watch(search, debounce((value) => {
    router.get(route('users.index'), { search: value }, { preserveState: true, replace: true });
}, 300));

const deleteUser = (id) => {
    if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
        form.delete(route('users.destroy', id));
    }
};
</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <Users class="w-6 h-6 text-indigo-500" />
                    Gestión de Usuarios
                </h2>
                
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <Search class="h-4 w-4 text-gray-400" />
                        </div>
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Buscar usuario..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                        />
                    </div>

                    <Link
                        :href="route('users.create')"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 focus:bg-indigo-600 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 shadow-md hover:shadow-lg whitespace-nowrap"
                    >
                        <Plus class="w-4 h-4" />
                        Nuevo Usuario
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.message" class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    {{ $page.props.flash.message }}
                </div>
                <div v-if="$page.props.flash.error" class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                    {{ $page.props.flash.error }}
                </div>

                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">Usuario</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">Correo</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300">Rol</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 dark:text-gray-300 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr 
                                    v-for="user in users.data" 
                                    :key="user.id"
                                    class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors"
                                >
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                                {{ user.name.charAt(0) }}{{ user.last_name.charAt(0) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-gray-100">{{ user.name }} {{ user.last_name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">@{{ user.username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-300">{{ user.email }}</td>
                                    <td class="py-4 px-6">
                                        <span 
                                            v-if="user.roles.length > 0"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium"
                                            :class="user.roles[0].name === 'Administrador' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300'"
                                        >
                                            <ShieldCheck v-if="user.roles[0].name === 'Administrador'" class="w-3.5 h-3.5" />
                                            <Shield v-else class="w-3.5 h-3.5" />
                                            {{ user.roles[0].name }}
                                        </span>
                                        <span v-else class="text-gray-400 italic">Sin rol</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-3 opacity-70 hover:opacity-100 transition-opacity">
                                            <Link 
                                                :href="route('users.edit', user.id)"
                                                class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 p-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/30"
                                            >
                                                <Edit class="w-5 h-5" />
                                            </Link>
                                            <button 
                                                @click="deleteUser(user.id)"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30"
                                                :disabled="user.id === $page.props.auth.user.id"
                                                :class="{'opacity-50 cursor-not-allowed': user.id === $page.props.auth.user.id}"
                                            >
                                                <Trash2 class="w-5 h-5" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="users.data.length === 0">
                                    <td colspan="4" class="py-12 text-center text-gray-500 dark:text-gray-400">
                                        No se encontraron usuarios.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <Pagination :links="users.links" class="mt-8" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
