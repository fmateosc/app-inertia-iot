<template>
    <app-layout title="Estacioness">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estaciones meteorológicas
            </h2>
        </template>

        <div class="py-12">
            <!-- Buscador -->
            <div
                class="w-full max-w-7xl mx-auto p-3 whitespace-nowrap0 "
            >
                <Input v-model="search" class="w-full" type="text" placeholder="¿Qué quiere buscar?" />
            </div>      

            <!-- Table -->
            <div
                class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200"
            >
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">ESTACIONES</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead
                                class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"
                            >
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            ID ESTACIÓN
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            NOMBRE ESTACIÓN
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            PAÍS
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            LATITUD
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            LONGITUD
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            Acciones
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr
                                    v-for="station in stations.data"
                                    :key="station.id"
                                >
                                    <!---------STATION ID---------------------------->
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ station.id }}
                                        </div>
                                    </td>
                                    <!---------STATION NAME---------------------------->
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ station.name }}
                                        </div>
                                    </td>
                                    <!---------COUNTRY---------------------------->
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ station.country_name }}
                                        </div>
                                    </td>
                                    <!---------LATITUD---------------------------->
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ station.lat }}
                                        </div>
                                    </td>
                                    <!---------LONGITUD---------------------------->
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ station.lon }}
                                        </div>
                                    </td>
                                    <!---------BOTONES DE ACCIONES---------------------------->
                                    <td class="p-2 whitespace-nowrap">  
                                        <jet-button
                                            class="bg-blue-500"
                                            type="btn"
                                            v-on:click="toggleModal(station)"    
                                        >
                                            <i class="fas fa-map text-white-800" aria-hidden="true"></i>                                        
                                        </jet-button>

                                        <jet-button 
                                            v-if="station.user_id"
                                            class="ml-2 bg-green-500"
                                            type="btn"
                                            v-on:click="activarDesactivar(station, 1)"    
                                        >
                                            <i class="fas fa-heart text-white-800" aria-hidden="true"></i>                                        
                                        </jet-button>

                                        <jet-button 
                                            v-else
                                            class="ml-2 bg-blue-500"
                                            type="btn"
                                            v-on:click="activarDesactivar(station, 1)"    
                                        >
                                            <i class="fas fa-heart" aria-hidden="true"></i>                                        
                                        </jet-button>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>

                        <Paginator :pagination="stations"></Paginator>
                    </div>

                    <!--Modal-->
                    <div
                        class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center"
                    >
                        <div
                            class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
                        ></div>

                        <div
                            class="modal-container bg-white w-full max-w-6xl mx-auto shadow-lg rounded-sm border border-gray-200 rounded shadow-lg z-50 overflow-y-auto"
                        >  
                            <!-- Add margin if you want to see some of the overlay behind the modal-->
                            <div class="modal-content py-4 text-left px-6">
                                <!--Title-->
                                <div
                                    class="pb-3"
                                >
                                    <p class="text-2xl font-bold">
                                        {{ modalTitle }}
                                    </p>
                                    <p class="text-1xl font-bold">
                                        {{ address }}
                                    </p>
                                </div>

                                <!--Body-->
                                <iframe 
                                    class="iframe" 
                                    :src="mapaSrc" 
                                    height="300" 
                                    frameborder="0"                                      
                                    allowfullscreen
                                >
                                </iframe>

                                <!--Footer-->
                                <div class="flex justify-end pt-2">
                                    <button
                                        class="modal-close mt-4 px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                                        v-on:click="closeModal()"
                                    >
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
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
    
    import Paginator from "@/Components/Paginator/Paginator"; 
    import Input from '@/Jetstream/Input';
    import pickBy from 'lodash/pickBy'; 
   
    export default defineComponent({
        props: {
            stations: Object,
        },
        data() {
            return {
                modalTitle: "",
                mapaSrc: "",
                coordenadas: {
                    lat: "",
                    lon: ""
                },
                address: "",
                search: ''        
            }
        },    
        components: {
            AppLayout,
            Link,
            JetButton,
            Paginator,
            Input
        }, 
        mounted() {
            this.serch = '';
        },
        watch: {
            search($value) {
                this.$inertia.get('estaciones', pickBy({ search: $value }  ), { preserveState: true })
            }
        },     
        computed: {},
        methods: {
            activarDesactivar(station, userId){
                Inertia.put(route("estaciones.activar-desactivar", {'station':station}), userId)
            },
            toggleModal(station) {
                let lat = station.lat;
                let lon = station.lon;

                this.geocodeInverse(lat , lon);

                this.modalTitle = station.name + ", " + station.country_name;
               
                this.mapaSrc = "https://maps.google.com/?ll="
                    + lat + "," + lon + "&z=14&t=m&output=embed&z=14";

                const body = document.querySelector("body");
                const modal = document.querySelector(".modal");
                modal.classList.toggle("opacity-0");
                modal.classList.toggle("pointer-events-none");
                body.classList.toggle("modal-active");
            },
            closeModal() {
                const body = document.querySelector("body");
                const modal = document.querySelector(".modal");
                modal.classList.toggle("opacity-0");
                modal.classList.toggle("pointer-events-none");
                body.classList.toggle("modal-active");
            },
            async geocodeInverse(lat, lon) {
                try {
                    this.coordenadas.lat = lat;
                    this.coordenadas.lon = lon;

                    const res = await axios.post(
                        "https://iotspain.xyz/maps/geocode", this.coordenadas
                    );

                    if (res.data.status == "success") {
                        this.address = res.data.data.results[0].formatted_address
                    }
                } catch (error) {}
            },         
        },
    });
</script>

<style scope>
    .modal {
        transition: opacity 0.25s ease;
    }

    body.modal-active {
        overflow-x: hidden;
        overflow-y: visible !important;
    }

    iframe {        
        border:0; 
        width:100%;
        margin-top: 20px;
    }
</style>
