<script>
    import Vue from 'vue'

    const largeMask = ['(', /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]
    const shortMask = ['(', /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]

    const originalMask = value => {
        if (!value || value.replace(/\D/g, '').length <= 10) {
            return shortMask
        }

        return largeMask
    }

    export default Vue.extend({
        name: 'PhoneInput',
        props: {
          value: {
              type: String,
              required: true
          }
        },
        data: () => ({
            phoneMask: originalMask
        })
    })
</script>

<template>
    <masked-input
        :value="value"
        :mask="phoneMask"
    />
</template>
