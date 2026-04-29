<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { PackageSearch, FolderTree, Archive, DollarSign, TrendingUp, Activity } from 'lucide-vue-next';

defineProps({
    stats: Object,
});

const formatCurrency = (value) => {
    return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(value);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <Activity class="w-6 h-6 text-indigo-500" />
                Dashboard General
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8 animate-fade-in-up">
                
                <!-- Welcome Section -->
                <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl p-8 shadow-xl text-white relative overflow-hidden group">
                    <div class="absolute inset-0 bg-black/10 transition-opacity group-hover:bg-transparent"></div>
                    <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="text-3xl font-bold mb-2 text-shadow">¡Bienvenido de nuevo, {{ $page.props.auth.user.name }}!</h3>
                            <p class="text-indigo-100 text-lg">Aquí tienes el resumen de tu sistema de inventario.</p>
                        </div>
                        <div class="hidden sm:block">
                            <TrendingUp class="w-24 h-24 text-white/20 transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Productos -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-500/10 dark:bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <h3 class="text-gray-500 dark:text-gray-400 font-medium text-sm uppercase tracking-wider">Productos Totales</h3>
                            <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                                <PackageSearch class="w-6 h-6" />
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white relative z-10">{{ stats.products }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 relative z-10">
                            <Link :href="route('products.index')" class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:underline flex items-center gap-1">
                                Ver todos <span aria-hidden="true">&rarr;</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Categorías -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 dark:bg-purple-500/5 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-colors"></div>
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <h3 class="text-gray-500 dark:text-gray-400 font-medium text-sm uppercase tracking-wider">Categorías</h3>
                            <div class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
                                <FolderTree class="w-6 h-6" />
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white relative z-10">{{ stats.categories }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 relative z-10">
                            <Link :href="route('categories.index')" class="text-purple-600 dark:text-purple-400 text-sm font-medium hover:underline flex items-center gap-1">
                                Ver todas <span aria-hidden="true">&rarr;</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Total Stock -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 dark:bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-colors"></div>
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <h3 class="text-gray-500 dark:text-gray-400 font-medium text-sm uppercase tracking-wider">Unidades en Stock</h3>
                            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400">
                                <Archive class="w-6 h-6" />
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white relative z-10">{{ stats.total_stock }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 relative z-10">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total de artículos físicos</p>
                        </div>
                    </div>

                    <!-- Valor Total -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-500/10 dark:bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors"></div>
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <h3 class="text-gray-500 dark:text-gray-400 font-medium text-sm uppercase tracking-wider">Valor Estimado</h3>
                            <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400">
                                <DollarSign class="w-6 h-6" />
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white relative z-10">{{ formatCurrency(stats.total_value) }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 relative z-10">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Valor potencial del inventario</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions / Info -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-lg rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Acciones Rápidas
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <Link :href="route('products.create')" class="flex flex-col items-center justify-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 border border-transparent hover:border-indigo-100 dark:hover:border-indigo-800 transition-all group">
                                <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm text-indigo-500 group-hover:scale-110 transition-transform">
                                    <PackageSearch class="w-6 h-6" />
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Nuevo Producto</span>
                            </Link>
                            <Link :href="route('categories.create')" class="flex flex-col items-center justify-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-purple-50 dark:hover:bg-purple-900/30 border border-transparent hover:border-purple-100 dark:hover:border-purple-800 transition-all group">
                                <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm text-purple-500 group-hover:scale-110 transition-transform">
                                    <FolderTree class="w-6 h-6" />
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Nueva Categoría</span>
                            </Link>
                        </div>
                    </div>
                    
                    <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl border border-indigo-100 dark:border-indigo-800/30 p-6 flex items-center justify-center">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-800 text-indigo-600 dark:text-indigo-300 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">Sistema Protegido</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-sm mx-auto">
                                Tu inventario está gestionado con las últimas tecnologías web, ofreciendo un entorno rápido, seguro y escalable.
                            </p>
                        </div>
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
.text-shadow {
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
