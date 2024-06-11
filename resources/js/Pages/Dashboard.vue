<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bienvenido dar click abajo en el botón celeste, para ver los posts
            </h2>
            <div class="py-12" >
            <Link href="/posts" class="btn btn-celeste">Ver los posts</Link>

             </div>
        </template>

       
    </AppLayout>
</template>
