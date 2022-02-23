<template>
    <Link
        :href="href"
        class="px-3 py-2 mr-2 rounded text-white text-sm font-bold whitespace-no-wrap"
        :class="classes"
    >
        <i 
          class="mr-2"
          :class="btnClasses"
        >
        </i>
        
        <slot />
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        href: String,
        mode: {
            type: String,
            default: 'add'
        }
    },
    components: {
        Link
    },
    computed: {
        classes() {
            if(this.mode == 'add') {
                return 'bg-blue-600 hover:bg-blue-800';
            }
            if(this.mode == 'edit') {
                return 'bg-purple-600 hover:bg-purple-800';
            }
            if(this.mode == 'delete') {
                return 'bg-red-600 hover:bg-red-800';
            }
            if(this.mode == 'view') {
                return 'bg-green-600 hover:bg-green-800';
            }
            return '';
        },
        btnClasses() {
          if(this.mode == 'add') {
                return 'fa fa-plus';
            }
        }
    }
}
</script>