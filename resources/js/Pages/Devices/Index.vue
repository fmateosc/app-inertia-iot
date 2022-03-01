<template>
    <app-layout title="Estacioness">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dispositivos
            </h2>
        </template>

        <div class="py-12">
            <!-- FORMULARIO -->
            <form @submit.prevent="submit">
                <div
                    class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mb-5"
                >
                    <header class="px-5 py-4 border-b border-gray-100">
                        <div class="flex items-center">{{ formTitle }}</div>
                    </header>

                    <div class="grid grid-cols-3 gap-5 px-5 mb-5 mt-3">
                        <div>
                            <Label
                                class="pb-1 font-bold"
                                for="device-id"
                                value="Id"
                            />
                            <Input
                                id="device-id"
                                v-model="form.device_id"
                                class="w-full p-4 bg-gray-100"
                                type="text"
                                placeholder="Id del dispositivo"
                                autofocus
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.device_id"
                            >
                            </input-error>
                        </div>

                        <div>
                            <Label
                                class="pb-1 font-bold"
                                for="device-name"
                                value="Nombre"
                            />
                            <Input
                                id="device-name"
                                v-model="form.name"
                                class="w-full p-4 bg-gray-100"
                                type="text"
                                placeholder="Nombre del dispositivo"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.name"
                            >
                            </input-error>
                        </div>

                        <div>
                            <Label
                                class="pb-1 font-bold"
                                for="device-type"
                                value="Tipo"
                            />
                            <Input
                                id="device-type"
                                v-model="form.type"
                                class="w-full p-4 bg-gray-100"
                                type="text"
                                placeholder="Tipo de dispositivo"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.type"
                            >
                            </input-error>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-4">
                        <reset-button
                            v-if="insertMode"
                            @click="resetForm()"
                        >
                            Reset
                        </reset-button>

                        <reset-button
                            v-else
                            @click="cancelEdit()"
                        >
                            Cancelar
                        </reset-button>

                        <jet-button
                            :class="{ 'opacity-25' : form.processing }"
                            :disabled="form.processing"
                        > 
                            Guardar 
                        </jet-button>
                    </div>
                </div>
            </form>

            <!-- Buscador -->
            <div class="w-full max-w-7xl mx-auto p-3 whitespace-nowrap0">
                <Input
                    v-model="search"
                    class="w-full p-4"
                    type="text"
                    placeholder="¿Qué quiere buscar?"
                />
            </div>

            <div
                class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-3"
            >
                <header class="px-5 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-end"></div>
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
                                        @click="
                                            changeSaveRuler(
                                                device.id,
                                                device.selected
                                            )
                                        "
                                        class="form-check-input appearance-none w-9 -ml-6 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheckChecked"
                                        checked
                                    />

                                    <input
                                        v-else
                                        @click="
                                            changeSaveRuler(
                                                device,
                                                device.id
                                            )
                                        "
                                        class="form-check-input appearance-none w-9 -ml-6 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheckChecked"
                                    />
                                </div>

                                <jet-button
                                    class="ml-3 bg-blue-500"
                                    type="btn"
                                    @click="editDevice(device)"
                                >
                                    <i
                                        class="fas fa-edit text-white-800"
                                        aria-hidden="true"
                                    ></i>
                                </jet-button>
                            </tr>
                        </Table>

                        <Paginator :pagination="devices"></Paginator>
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

import Label from "@/Jetstream/Label";
import Input from "@/Jetstream/Input";
import InputError from "@/Jetstream/InputError";
import ResetButton from "@/Components/Buttons/ResetButton";
import { useForm } from "@inertiajs/inertia-vue3";

export default defineComponent({
    props: {
        devices: Object,
    },
    data() {
        return {
            search: "",
            formTitle: "",
            insertMode: true,
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
        Label,
        Input,
        InputError,
        ResetButton
    },
    setup() {
        const form = useForm({
            id: "",
            device_id: "",
            type: "",
            name: "",
            selected: 0,
        });

        return { form };
    },
    mounted() {
        this.formTitle = "Nuevo Dispositivo";
        this.insertMode = true;
    },
    watch: {
        search($value) {
            this.$inertia.get("dispositivos", pickBy({ search: $value }), {
                preserveState: true,
            });
        },
    },
    computed: {},
    methods: {
        changeSaveRuler(device, id) {
            Inertia.put(route("dispositivos.activar-desactivar", {'device':device}), id)
        },
        submit() {
            if (this.insertMode) {
                this.form.post(route("dispositivos.store"));

                this.insertMode = true;
                this.form.clearErrors();
                this.form.reset();
            } else {
                this.form.put(route("dispositivos.update", this.form.id));

                this.formTitle = "Nuevo Dispositivo";
                this.insertMode = true;
                this.form.clearErrors();
                this.form.reset();

                document.getElementById("device-id").focus();
            }
        },
        editDevice(device) {
            this.form.id = device.id;
            this.form.device_id = device.device_id;
            this.form.name = device.name;
            this.form.type = device.type;

            this.formTitle = "Editar Dispositivo";
            this.insertMode = false;
        },
        resetForm() {
            this.form.reset();

            document.getElementById("device-id").focus();
        },
        cancelEdit() {
            this.insertMode = true;
            this.formTitle = "Nuevo Dispositivo";

            this.form.reset();

            document.getElementById("device-id").focus();
        }
    },
});
</script>
