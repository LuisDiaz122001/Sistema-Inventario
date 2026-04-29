<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Package, ArrowRight, Lock } from 'lucide-vue-next';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div class="min-h-screen flex items-center justify-center bg-zinc-50 dark:bg-zinc-950 font-sans px-4 sm:px-6 lg:px-8 selection:bg-indigo-500 selection:text-white">
        
        <div class="w-full max-w-md animate-fade-in-up">
            
            <!-- Minimalist Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 mb-6 shadow-xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <Package class="w-8 h-8" />
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100">
                    Bienvenido de nuevo
                </h1>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                    Ingresa a tu cuenta para gestionar el inventario.
                </p>
            </div>

            <!-- Status Message -->
            <div v-if="status" class="mb-6 p-4 rounded-xl bg-green-50/50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-sm font-medium text-green-600 dark:text-green-400 text-center">
                {{ status }}
            </div>

            <!-- Login Form -->
            <div class="bg-white dark:bg-zinc-900 py-8 px-6 sm:px-10 shadow-2xl shadow-zinc-200/50 dark:shadow-black/50 rounded-3xl border border-zinc-100 dark:border-zinc-800">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="email" value="Correo electrónico" class="text-zinc-700 dark:text-zinc-300 mb-1" />
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full bg-zinc-50 dark:bg-zinc-950 border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-0 rounded-xl transition-colors sm:text-sm h-12 px-4"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="tu@ejemplo.com"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <InputLabel for="password" value="Contraseña" class="text-zinc-700 dark:text-zinc-300" />
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors"
                            >
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>
                        <TextInput
                            id="password"
                            type="password"
                            class="block w-full bg-zinc-50 dark:bg-zinc-950 border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-0 rounded-xl transition-colors sm:text-sm h-12 px-4"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" class="border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 focus:ring-zinc-900 dark:focus:ring-zinc-100 rounded" />
                        <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">Recordarme</span>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                            :disabled="form.processing"
                            class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 dark:focus:ring-offset-zinc-950 transition-all duration-200"
                        >
                            <Lock v-if="form.processing" class="w-4 h-4 animate-pulse" />
                            <span v-else>Iniciar Sesión</span>
                            <ArrowRight v-if="!form.processing" class="w-4 h-4" />
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="mt-8 text-center text-sm text-zinc-500 dark:text-zinc-400">
                ¿No tienes una cuenta?
                <Link :href="route('register')" class="font-medium text-zinc-900 hover:text-zinc-700 dark:text-zinc-100 dark:hover:text-zinc-300 underline underline-offset-4 transition-colors">
                    Regístrate aquí
                </Link>
            </p>
        </div>
    </div>
</template>

<style>
@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>
