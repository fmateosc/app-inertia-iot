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
                        <AnchorLink :href="route('dispositivos.create')"
                            >Nuevo Dispositivo</AnchorLink
                        >
                    </div>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <!---------TABLA---------------------------->
                        <Table>
                            <template #header>
                                <TableC>ID</TableC>
                                <TableC>ID DISPOSITIVO</TableC>
                                <TableC>NOMBRE</TableC>
                                <TableC>TIPO</TableC>
                                <TableC>ACCIONES</TableC>
                            </template>

                            <tr
                                class="hover:bg-gray-200"
                                v-for="device in devices.data"
                                :key="device.id"
                            >
                                <!---------ID---------------------------->
                                <TableC>{{ device.id }}</TableC>
                                <!---------DEVICE ID---------------------------->
                                <TableC>{{ device.device_id }}</TableC>
                                <!---------DEVICE NAME---------------------------->
                                <TableC>{{ device.name }}</TableC>
                                <!---------DEVICE TYPE---------------------------->
                                <TableC>{{ device.type }}</TableC>
                                <!---------BOTONES DE ACCIONES---------------------------->
                                <div class="form-check form-switch">
                                    <input
                                        v-if="device.selected"
                                        @click="changeSaveRuler(device.id, device.selected)"
                                        class="form-check-input appearance-none w-9 -ml-6 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheckChecked"                                        
                                        checked
                                    />

                                    <input
                                        v-else
                                        @click="changeSaveRuler(device.id, device.selected)"
                                        class="form-check-input appearance-none w-9 -ml-6 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheckChecked" 
                                    />
                                </div>
                            </tr>
                        </Table>
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
        AnchorLink,
    },
    mounted() {},
    watch: {},
    computed: {},
    methods: {
        changeSaveRuler(id, selected){
            console.log(id + "   " + selected)
            //this.devices[id].saverRule = this.devices[id].saverRule;
        }
    },
});
</script>
