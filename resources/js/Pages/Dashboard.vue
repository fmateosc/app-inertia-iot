<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                    <AlertBorder
                        title="ALERTA"
                        color="green"
                    >
                        Alerta con borde
                    </AlertBorder>
                
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    import AlertBorder from "@/Components/Alerts/AlertBorder";

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            AlertBorder
        },
    })
</script>
