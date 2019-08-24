<template>
    <BasePanel 
        icon="voyager-file-text"
        name="voyager.sales_orders.document"
    >
        <template 
            v-slot:body
        >
            <BaseLoader ></BaseLoader>
            <div class="row">
                <div class="from-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.document_name') }}</label>
                    <input 
                        type="text" 
                        v-model="document.name" 
                        class="form-control"
                    >
                </div>
                <div class="from-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.document_type') }}</label>
                    <input 
                        type="text" 
                        v-model="document.name" 
                        class="form-control"
                    >
                </div>
                <div class="from-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.document_status') }}</label>
                    <input 
                        type="text" 
                        v-model="document.name" 
                        class="form-control"
                    >
                </div>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../../baseComponents/BasePanel';
    import BaseLoader from '../../baseComponents/BaseLoader';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'documentPanel',

        components: {
            BasePanel,
            BaseLoader
        }
    }
</script>

<style lang="sass" scoped>

</style>