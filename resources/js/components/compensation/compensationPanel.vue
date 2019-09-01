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
                    <select 
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
                    </select>
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
                </div>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../baseComponents/BasePanel';
    import BaseLoader from '../baseComponents/BaseLoader';
    import { mapActions, mapGetters } from 'vuex';
    import { ToggleButton } from "vue-js-toggle-button";
    import valueCard from './compensationValueCard';
    import valueCardFrom from './compensationValueCardForm';

    export default {
        name: 'compensationPanel',

        components: {
            BasePanel,
            BaseLoader,
            valueCard,
            ToggleButton,
            valueCardFrom
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
            }
        },

        methods: {
            ...mapActions('compensations',['fetchCompensation'])
        },
    }
</script>

<style lang="sass" scoped>
h4 
    color: #344055

.toggle-button-wrapper
    margin-top: 0.9em
</style>