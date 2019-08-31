<template>
    <BasePanel
        name="voyager.compensations.compensations"
        icon="voyager-dollar"
    >
        <template v-slot:body>
            <BaseLoader
                v-if="isLoading"
            ></BaseLoader>
            <!-- insurance provision -->
            <div class="row">
                <h4>{{ trans.get('voyager.compensations.insurance_provision') }}</h4>
                <!-- insurace -->
                <div class="form-group col-md-4">
                    <label class="control-labe">
                        {{ trans.get('voyager.insurance.insurance') }}
                    </label>
                    <select class="form-control">
                        <option 
                            v-for="insurance in insurances"
                            value="insurance.id"
                            :key="insurance.id"
                        >
                            {{ insurance.name }}
                        </option>
                    </select>
                </div>
                <!-- SBZ sales order -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.sbz_sales_order_id') }}
                    </label>
                    <select class="form-control">
                        <option
                        >
                        </option>
                    </select>
                </div>

            </div>
            <!-- sales compensations -->
            <div class="row">
                <h4>{{ trans.get('voyager.compensations.sales_compensations') }}</h4>
                <form-group class="col-md-4"></form-group>
                <form-group class="col-md-4"></form-group>
                <form-group class="col-md-4"></form-group>
                <form-group class="col-md-4"></form-group>
                <form-group class="col-md-4"></form-group>
                <form-group class="col-md-4"></form-group>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../baseComponents/BasePanel';
    import BaseLoader from '../baseComponents/BaseLoader';
    import { mapActions, mapGetters } from 'vuex';

    export default {
        name: 'compensationPanel',

        components: {
            BasePanel,
            BaseLoader
        },

        computed: {
            ...mapGetters('compensations',['isLoading']),
            ...mapGetters(['insurances'])
        },

        methods: {
            ...mapActions('compensations',['fetchCompensation'])
        },

        mounted() {
            this.fetchCompensation();
        }
    }
</script>

<style lang="sass" scoped>
h4 
    color: #344055
</style>