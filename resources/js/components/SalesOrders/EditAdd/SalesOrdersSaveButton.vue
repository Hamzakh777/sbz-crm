<template>
    <button
        class="btn btn-success btn-save"
        @click="storeSalesOrder"
    >
        <i class="voyager-check-circle"></i>
        <span>{{ trans.get('voyager.generic.save') }}</span>
    </button>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: 'SalesOrdersSaveButton',

        methods: {
            ...mapActions(['storeSalesOrder'])
        }
    }
</script>

<style lang="sass" scoped>
.btn
    margin-top: 2px 
    
    i 
        position: relative
        top: 2px
</style>