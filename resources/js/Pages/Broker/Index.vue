<template>
    <app-layout title="Broker">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Broker
            </h2>
        </template>

<div class="py-12">
    <div class="w-full max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-4">
            <div class="flex flex-col items-center justify-center bg-white p-4 shadow rounded-lg">
                <div>
                    <i class="fa fa-file fa-8x"></i>
                </div>

                <h2 class="mt-4 font-bold text-xl">Nombre del sistema</h2>
                <h6 class="mt-2 text-xl">{{ broker.systemName }}</h6>
            </div>

            <div class="flex flex-col items-center justify-center bg-white p-4 shadow rounded-lg">
                <div>
                    <i class="fab fa-buffer fa-8x"></i>
                </div>

                <h2 class="mt-4 font-bold text-xl">Versión</h2>
                <h6 class="mt-2 text-xl">{{ broker.version }}</h6>
            </div>

            <div class="flex flex-col items-center justify-center bg-white p-4 shadow rounded-lg">
                <div>
                    <i class="fa fa-clock fa-8x"></i>
                </div>

                <h2 class="mt-4 font-bold text-xl">Tiempo de funcionamiento</h2>
                <h6 class="mt-2 text-xl">{{ broker.uptime }}</h6>
            </div>
        </div>
    </div>
</div>
</app-layout>
</template>

<script>
    import {
        defineComponent
    } from "vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
    import {
        Inertia
    } from "@inertiajs/inertia";

    export default defineComponent({
        props: {},
        data() {
            return {
                broker: {
                    systemName: "",
                    version: "",
                    uptime: "",
                },
            };
        },
        components: {
            AppLayout,
        },
        computed: {},
        methods: {
            async getBrokerInfo() {
                try {
                    const res = await axios.get(
                        "https://iotspain.xyz/broker/get-broker-info"
                    );

                    if (res.data.status == "success") {
                        this.broker.systemName = res.data.data.data[0].sysdescr;
                        this.broker.version = res.data.data.data[0].version;
                        
                        let uptime = res.data.data.data[0].uptime;
                        uptime = uptime.split(',');

                        this.broker.uptime = uptime[0].replace('days', 'dias') 
                            + ', ' + uptime[1].replace('hours', 'horas') 
                            + ', ' + uptime[2].replace('minutes', 'minutos');
                    }

                    //Actualizamos la información del broker cada minuto
                    setTimeout(() => {
                        this.getBrokerInfo();
                    }, 60000);
                } catch (error) {}
            },
        },
        mounted() {
            this.getBrokerInfo();
        },
    });
</script>