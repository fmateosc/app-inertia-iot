<template>
    <app-layout title="Estacioness">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dispositivos
            </h2>
        </template>

        <div class="py-12">
            <!-- Buscador -->           
            
            
            <div
                class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200"
            >
                <header class="px-5 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-end">
                      <AnchorLink :href="route('dispositivos.create')">Nuevo Dispositivo</AnchorLink>
                    </div>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        

                        
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";

import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";

import TableC from "@/Components/Table/TableColumn.vue";
import Table from "@/Components/Table/Table.vue";
import AnchorLink from "@/Components/AnchorLink.vue";

import Paginator from "@/Components/Paginator/Paginator";
import pickBy from "lodash/pickBy";

export default defineComponent({
    props: {
        devices: Object,
    },
    data() {
        return {
            search: "",
        };
    },
    components: {
        AppLayout,
        Link,
        JetButton,
        Paginator,
        TableC,
        Table,
        AnchorLink
    },
    mounted() {
        
    },
    watch: {
        
    },
    computed: {},
    methods: {
    },
});
</script>


