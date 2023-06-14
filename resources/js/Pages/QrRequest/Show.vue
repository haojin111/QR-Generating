<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import QrCard from '@/Components/QrCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';

const props = defineProps({
    svg: String
});

</script>

<template>
    <Head title="QR Request" />

    <QrCard :not-full="true">
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <a class="absolute mb-4 right-10 hover:text-red-800" :href="route('qrs.index')">&lt; Back</a>
        <div class="mt-10 p-2 inline-block bg-white" v-html="svg" />        
    </QrCard>
</template>
