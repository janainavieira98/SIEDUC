<script>
  import Vue from 'vue';

  export default Vue.extend({
    name: 'CreateClassroom',
    data: () => ({
      classdays: []
    }),
    methods: {
      addClassday() {
        console.log('added')
      }
    },
    mounted() {
      console.log('mounted create classrooms')
    }
  });
</script>

<template>
    <div>
        <slot name="body"/>
    </div>
</template>
