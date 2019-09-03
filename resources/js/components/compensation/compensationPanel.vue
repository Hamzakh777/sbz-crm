<template>
    <BasePanel
        name="voyager.compensations.compensations"
        icon="voyager-dollar"
        :showFooter="true"
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
                    <select 
                        class="form-control"
                        v-model="compensation.insuranceId"
                        >
                        <option 
                            v-for="insurance in allInsurances"
                            :value="insurance.id"
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
                    <!-- <select 
                        class="form-control"
                        v-model="compensation.salesOrderId"
                        >
                        <option
                            v-for="salesOrder in allSalesOrders"
                            :key="salesOrder.id"
                            :value="salesOrder.id"
                        >
                            {{ salesOrder.id }}
                        </option>
                    </select> -->
                    <div>
                        <vSelect 
                            :value="compensation.salesOrder.id"
                            @input="setSelected"
                            :filterable="false"
                            :options="salesOrdersIdsList"
                            @search="fetchSalesOrders">
                        </vSelect>
                        <div v-if="$v.search.$error">
                            <span class="error-text" v-if="!$v.search.numeric">
                                {{ trans.get('validation_js.numeric_only') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- insurance provision period plan -->
                <div class="form-group col-md-2">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.period_plan') }}
                    </label>
                    <div class="row">
                        <div class="col-md-6">
                            <select 
                                class="form-control "
                                v-model="compensation.insuranceProvisoinPeriodPlanMonth"
                            >
                                <option 
                                    v-for="n in 12"
                                    :key="n"
                                    :value="n"
                                >
                                    {{ n }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select 
                                class="form-control "
                                v-model="compensation.insuranceProvisoinPeriodPlanYear"
                            >
                                <option 
                                    v-for="n in periodplanYears"
                                    :key="n"
                                    :value="n">{{ n }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- period plan completed -->
                <div class="form-group col-md-2">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.period_plan_completed') }}
                    </label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="compensation.insuranceProvisionPeriodPlanCompleted"
                            :sync="true"
                            :value="compensation.insuranceProvisionPeriodPlanCompleted"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- total paid provision -->
                    <valueCardFrom
                        name="voyager.compensations.total_provision_paid"
                        :propertyName="'totalProvisionPaid'"
                        accentColor="#2ecc71"
                    >
                    </valueCardFrom>
                </div>

                <!-- total expected provision -->
                <div class="col-md-4">
                    <valueCard
                        name="voyager.compensations.total_expected_provision"
                        :value="totalExpectedProvision"
                        accentColor="#4E73DF"
                    >
                    </valueCard>
                </div>

                <!-- total provision open -->
                <div class="col-md-4">
                    <valueCard
                        name="voyager.compensations.total_provision_open"
                        :value="totalProvisionOpen"
                        :accentColor="totalProvisionOpen === 0 ? '#2ecc71' :'#fa2a00'"
                    >
                    </valueCard>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.provision_feedback') }}
                    </label>
                    <textarea 
                        class="form-control" 
                        v-model="compensation.provisionFeedback"
                        cols="30" 
                        rows="5">
                    </textarea>
                </div>
            </div>

            <!-- sales compensations -->
            <div class="row">
                <h4>{{ trans.get('voyager.compensations.sales_compensations') }}</h4>
                <div class="row">
                    <!-- period plan -->
                    <div class="form-group col-md-2">
                        <label class="control-label">
                            {{ trans.get('voyager.compensations.period_plan') }}
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <select 
                                    class="form-control "
                                    v-model="compensation.salesCompensationsPeriodPlanMonth"
                                >
                                    <option 
                                        v-for="n in 12"
                                        :key="n"
                                        :value="n"
                                    >
                                        {{ n }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select 
                                    class="form-control "
                                    v-model="compensation.salesCompensationsPeriodPlanYear"
                                >
                                    <option 
                                        v-for="n in periodplanYears"
                                        :key="n"
                                        :value="n">{{ n }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- period plan completed -->
                    <div class="form-group col-md-2">
                        <label class="control-label">
                            {{ trans.get('voyager.compensations.period_plan_completed') }}
                        </label>
                        <div class="toggle-button-wrapper">
                            <toggle-button
                                v-model="compensation.insuranceProvisionPeriodPlanCompleted"
                                :sync="true"
                                :value="compensation.insuranceProvisionPeriodPlanCompleted"
                                :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <valueCard
                            name="voyager.compensations.sales_compensations_total"
                            :value="salesCompensationsTotal"
                            accentColor="#4E73DF"
                        >
                        </valueCard>
                    </div>

                    <!-- sales compensations payout rate -->
                    <div class="form-group col-md-4">
                        <valueCardFrom
                            name="voyager.compensations.sales_compensations_payout_rate"
                            :propertyName="'payoutRate'"
                            accentColor="#2ecc71"
                            :isSlider="true"
                        >
                        </valueCardFrom>
                    </div>

                    <!-- sales compensations to be paid -->
                    <div class="form-group col-md-4">
                        <valueCard
                            name="voyager.compensations.sales_compensations_to_be_paid"
                            :value="compensationToBePaid"
                            accentColor="#2ecc71"
                        >
                        </valueCard>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.sales_compensation_feedback') }}
                    </label>
                    <textarea 
                        class="form-control" 
                        v-model="compensation.salesCompensationFeedback"
                        cols="30" 
                        rows="5">
                    </textarea>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="row">
                <button
                    class="btn btn-success pull-right"
                    @click.prevent="submit"
                >
                    {{ trans.get('voyager.generic.save') }}
                </button>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../baseComponents/BasePanel';
    import BaseLoader from '../baseComponents/BaseLoader';
    import { mapActions, mapGetters, mapMutations } from 'vuex';
    import { ToggleButton } from "vue-js-toggle-button";
    import valueCard from './compensationValueCard';
    import valueCardFrom from './compensationValueCardForm';
    import {required, integer, minValue } from 'vuelidate/lib/validators';
    import vSelect from 'vue-select';

    export default {
        name: 'compensationPanel',

        components: {
            BasePanel,
            BaseLoader,
            valueCard,
            ToggleButton,
            valueCardFrom,
            vSelect
        },

        computed: {
            ...mapGetters('compensations',['isLoading', 'compensation']),
            ...mapGetters(['allInsurances', 'allSalesOrders']),

            /**
             * years from now to 17 years later
             * @return {Array}
             */
            periodplanYears() {
                const date = new Date();
                const year = date.getFullYear();
                let result = [];
                for (let index = year; index < year + 18; index++) {
                    result.push(index);
                }
                return result;
            },

            /**
             * Sum of all product values with the same field
             * requires a sales order to be selected  
             * @return {Number}
             */
            totalExpectedProvision() {
                return 12042;
            },

            totalProvisionOpen() {
                return this.totalExpectedProvision - this.compensation.totalProvisionPaid;
            },

            salesCompensationsTotal() {
                return 12042;
            },

            compensationToBePaid() {
                return (this.salesCompensationsTotal * this.compensation.payoutRate) / 100;
            }
        },

        data() {
            return {
                search: null,
                salesOrdersIdsList: []
            }
        },

        validations: {
            search: {
                integer,
                required,
                minValue: minValue(1)
            }
        },

        methods: {
            ...mapActions('compensations',['fetchCompensation']),
            ...mapMutations('compensations', ['setSalesOrder']),

            async fetchSalesOrders(search, loading) {
                // we want to vaidate that search is a numeric value
                this.search = search;
                this.$v.$touch();
                if(!this.$v.$invalid) {
                    loading(true); 
                    try {
                        const response = await axios.get(`/api/sales-orders/${search}`);

                        // we reset the list before adding a new item(s)
                        this.salesOrdersIdsList = [];
                        this.salesOrdersIdsList.push(response.data.salesOrder.id);
                        loading(false);
                    } catch (error) {
                        loading(false);
                        alert(error);
                    }
                }
            },

            /** 
             * When working with vuex
             * we cant mutate the state directly 
             * so we trigger an action to do it
            */
            setSelected(value) {
                if(value !== undefined && value !== null && value !== '') {
                    this.setSalesOrder(value);
                } else {
                    this.setSalesOrder({
                        id: null,
                        people: null
                    })
                }
            },

            /**
             * handle the submitting of the data
             */
            submit() {
                if(this.compensation.id === null) {
                    console.log('store');
                } else {
                    console.log('update');
                }
            }

        },
    }
</script>

<style lang="sass" scoped>

h4 
    color: #344055


.toggle-button-wrapper 
    margin-top: 0.9em


.v-select 
    padding-top: 6px 

</style>