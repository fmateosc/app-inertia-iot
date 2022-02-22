<template>
    <div
        class="border-l-4 p-4"
        :class="[alertColor]"
        role="alert"
    >
        <p class="font-bold" v-html="title"></p>
        <p><slot></slot></p>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['title', 'color'],
        data() {
            return {
                
            };
        },
        methods: {
            
        },
        computed: {
           alertColor() {
                return `bg-${this.color}-100 border-${this.color}-500 text-${this.color}-700`;
            },
        }
    })
</script>