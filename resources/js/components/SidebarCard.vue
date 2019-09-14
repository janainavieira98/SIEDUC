<script>
    import Vue from 'vue'

    export default Vue.extend({
        name: 'SidebarCard',
        data: () => ({
            collapse: window.innerWidth < 768
        })
    })
</script>

<template>
    <div class="sidebar-card">

        <div class="card mb-2">
            <div @click="collapse = !collapse" class="card-header cursor-pointer bg-secondary text-white font-weight-bold text-capitalize">
                <slot name="header"/>
            </div>
        </div>
        <div :class="{collapse: collapse}">
            <slot name="body"/>
        </div>
    </div>
</template>

