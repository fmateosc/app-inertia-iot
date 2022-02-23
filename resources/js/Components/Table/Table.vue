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
            </div>            
        </div>
    </div>
</template>
