<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { PackageSearch, ArrowLeft, Save, UploadCloud } from 'lucide-vue-next';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

defineProps({
    categories: Array,
});

const form = useForm({
    code: '',
    name: '',
    price: '',
    stock: '',
    category_id: '',
    image: null,
});

const imagePreview = ref(null);

const handleImageUpload = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    form.post(route('products.store'));
};
</script>

<template>
    <Head title="Nuevo Producto" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('products.index')"
                    class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                >
                    <ArrowLeft class="w-5 h-5" />
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <PackageSearch class="w-6 h-6 text-indigo-500" />
                    Nuevo Producto
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8 animate-fade-in-up">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Código -->
                                <div>
                                    <InputLabel for="code" value="Código de Producto" class="text-gray-700 dark:text-gray-300" />
                                    <TextInput
                                        id="code"
                                        type="text"
                                        class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                        v-model="form.code"
                                        required
                                        autofocus
                                        placeholder="Ej: PROD-001"
                                    />
                                    <InputError class="mt-2" :message="form.errors.code" />
                                </div>

                                <!-- Nombre -->
                                <div>
                                    <InputLabel for="name" value="Nombre" class="text-gray-700 dark:text-gray-300" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                        v-model="form.name"
                                        required
                                        placeholder="Ej: Laptop HP Envy"
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <!-- Precio -->
                                <div>
                                    <InputLabel for="price" value="Precio" class="text-gray-700 dark:text-gray-300" />
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <TextInput
                                            id="price"
                                            type="number"
                                            step="0.01"
                                            class="block w-full pl-7 bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                            v-model="form.price"
                                            required
                                            placeholder="0.00"
                                        />
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.price" />
                                </div>

                                <!-- Stock -->
                                <div>
                                    <InputLabel for="stock" value="Stock Inicial" class="text-gray-700 dark:text-gray-300" />
                                    <TextInput
                                        id="stock"
                                        type="number"
                                        class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg"
                                        v-model="form.stock"
                                        required
                                        placeholder="Ej: 100"
                                    />
                                    <InputError class="mt-2" :message="form.errors.stock" />
                                </div>

                                <!-- Categoría -->
                                <div>
                                    <InputLabel for="category_id" value="Categoría" class="text-gray-700 dark:text-gray-300" />
                                    <select
                                        id="category_id"
                                        v-model="form.category_id"
                                        class="mt-1 block w-full bg-gray-50/50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm rounded-lg dark:text-gray-300"
                                        required
                                    >
                                        <option value="" disabled selected>Seleccione una categoría</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.category_id" />
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="mt-6">
                                <InputLabel value="Imagen del Producto (Opcional)" class="text-gray-700 dark:text-gray-300 mb-2" />
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors bg-gray-50/30 dark:bg-gray-900/30 relative">
                                    <div class="space-y-1 text-center" v-if="!imagePreview">
                                        <UploadCloud class="mx-auto h-12 w-12 text-gray-400" />
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                            <label for="image-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Sube un archivo</span>
                                                <input id="image-upload" name="image-upload" type="file" class="sr-only" @change="handleImageUpload" accept="image/*">
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            PNG, JPG, GIF hasta 3MB
                                        </p>
                                    </div>
                                    <div v-else class="relative group">
                                        <img :src="imagePreview" alt="Preview" class="max-h-48 rounded-lg shadow-md">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                            <label for="image-upload-change" class="cursor-pointer text-white font-medium px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg backdrop-blur-sm transition-colors">
                                                Cambiar Imagen
                                                <input id="image-upload-change" type="file" class="sr-only" @change="handleImageUpload" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <div class="flex items-center justify-end pt-4 border-t border-gray-100 dark:border-gray-700 mt-8 gap-3">
                                <Link
                                    :href="route('products.index')"
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
                                    Guardar Producto
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
