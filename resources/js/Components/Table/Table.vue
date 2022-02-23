<template>
    <div>
        <div class="p-3">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead
                        class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"
                    >
                        <tr>
                            <slot name="header" />
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <slot />
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
                        <div class="pb-3">
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
</template>
