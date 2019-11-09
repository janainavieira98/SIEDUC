<script>
  import Vue from 'vue';

  export default Vue.extend({
    name: 'SelectMultiple',
    props: {
      valueKey: {
        type: String,
        required: true,
      },
      labelKey: {
        type: String,
        required: true,
      },
      options: {
        type: Array,
        required: true,
      },
      selected: {
        type: Array,
        required: false,
      },
    },
    data: () => ({
      value: [],
    }),
    watch: {
      value(val) {
        console.log(val);
      },
    },
    mounted() {
      this.value = this.selected || []
    },
  });
</script>

<template>
    <select class="form-control" multiple v-model="value">
        <option :value="option[valueKey]" class="text-capitalize" v-for="option in options">
            {{ option[labelKey] }}
        </option>
    </select>
</template>
