<template>
    <div class="flex flex-col items-center justify-center bg-white p-4 shadow rounded-lg">
      <div>
          <i :class=icon></i>
      </div>

      <h2 class="mt-4 font-bold text-xl">{{ title }}</h2>
      <h6 class="mt-2 text-xl">{{ message }}</h6>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['title', 'message', 'icon']
    })
</script>