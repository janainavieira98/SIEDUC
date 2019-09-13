<script>
    import Vue from 'vue'

    const phoneMask = value => {
        if (value.replace(/\D/g, '').length <= 10) {
            return ['(', /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/,]
        }

        return ['(', /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/,]
    }

    export default Vue.extend({
        name: 'PhoneInput',
        data: () => ({
            phoneMask
        })
    })
</script>

<template>
    <masked-input
        :mask="phoneMask"
    />
</template>
