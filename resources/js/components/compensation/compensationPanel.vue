<template>
    <BasePanel
        name="voyager.compensations.compensation_details"
        icon="voyager-plus"
        :showFooter="true"
    >
        <template v-slot:body>
            <BaseLoader
                v-if="isLoading"
            ></BaseLoader>
            <!-- insurance provision -->
            <div class="row">
                <h4 class="title">{{ trans.get('voyager.compensations.insurance_provision') }}</h4>
                <!-- insurace -->
                <div class="form-group col-md-4">
                    <label class="control-labe">
                        {{ trans.get('voyager.insurance.insurance') }}
                    </label>
                    <select 
                        class="form-control"
                        v-model="compensation.insuranceId"
                        :class="{'form-control--error': $v.compensation.insuranceId.$error }"
                        >
                        <option 
                            v-for="insurance in allInsurances"
                            :value="insurance.id"
                            :key="insurance.id"
                        >
                            {{ insurance.name }}
                        </option>
                    </select>
                    <div v-if="$v.compensation.insuranceId.$error ">
                        <span class="error-text" v-if="!$v.compensation.insuranceId.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- SBZ sales order -->
                <div 
                    v-if="!salesOrderPage"
                    class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.sbz_sales_order_id') }}
                    </label>
                    <div>
                        <vSelect 
                            :value="compensation.salesOrder.id"
                            @input="setSelected"
                            :filterable="false"
                            :options="salesOrdersIdsList"
                            @search="fetchSalesOrders">
                        </vSelect>
                        <div v-if="$v.compensation.salesOrder.id.$error && !$v.compensation.salesOrder.id.required">
                            <span class="error-text" v-if="!$v.compensation.salesOrder.id.required">
                                {{ trans.get('validation_js.required') }}
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
                                v-model="compensation.insuranceProvisionPeriodPlanMonth"
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
                                v-model="compensation.insuranceProvisionPeriodPlanYear"
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
                <h4 class="title">{{ trans.get('voyager.compensations.sales_compensations') }}</h4>
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
                                    v-model="compensation.salesCompensationPeriodPlanMonth"
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
                                    v-model="compensation.salesCompensationPeriodPlanYear"
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
                                v-model="compensation.salesCompensationPeriodPlanCompleted"
                                :sync="true"
                                :value="compensation.salesCompensationPeriodPlanCompleted"
                                :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- sales compensations total -->
                    <div class="form-group col-md-4">
                        <valueCardFrom
                            name="voyager.compensations.sales_compensations_total"
                            :propertyName="'totalSalesCompensation'"
                            accentColor="#4E73DF"
                        >
                        </valueCardFrom>
                        <small>If set to 0, it will be calculated using the added products</small>
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
                <!-- sales compensations feedback -->
                <div class="col-md-12 form-group">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.sales_compensation_feedback') }}
                    </label>
                    <textarea 
                        class="form-control" 
                        v-model="compensation.salesCompensationFeedback"
                        cols="30" 
                        :class="{'form-control--error': $v.compensation.salesCompensationFeedback.$error }"
                        rows="5">
                    </textarea>
                    <div v-if="$v.compensation.salesCompensationFeedback.$error">
                        <span class="error-text" v-if="!$v.compensation.salesCompensationFeedback.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
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

        props: {
            salesOrderPage: {
                type: Boolean,
                required: false,
                default: false
            }
        },

        watch: {
            'compensation.id': function(newVal, oldVal) {
                if(oldVal === null) {
                    this.fetchCompensation();
                }
            },

            /**
             * The default value for the totalSalesCompensation
             * is calculated using the sales order people products,
             * Thus we need to watch if the products change so we can recalculate it,
             * yes we could have used a computed property for this, but we need the value 
             * to be also stored in the backend, that's why we test again 0 since its the 
             * default one
             */
            'compensation.salesOrder.people': function(newVal, oldVal) {
                const people = newVal;
                try {
                    if(people !== null && this.compensation.totalSalesCompensation === 0) {
                        const sum = this.calcSumOfProducts(people, 'compensation');
                        this.setTotalSalesCompensations(sum);
                    }
                } catch (error) {
                    console.log(error);
                }
            },


            /**
             * The same component will be used on the sales order page,
             * we will have access to the sales order added products, 
             * thus watching the compensation salesorder people will
             * not do the job
             */
            'salesOrder.people': function(newVal, oldVal) {
                const people = newVal;
                try {
                    if(people !== null && this.compensation.totalSalesCompensation === 0) {
                        const sum = this.calcSumOfProducts(people, 'compensation');
                        this.setTotalSalesCompensations(sum);
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        },

        computed: {
            ...mapGetters('compensations',['isLoading', 'compensation', 'salesOrderPeople']),
            ...mapGetters(['allInsurances', 'salesOrder']),

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
             * Sum of all product values - provision - with the same field
             * requires a sales order to be selected  
             * @param {}
             * @return {Number}
             */
            totalExpectedProvision() {
                if(this.compensation.salesOrder.id === null && !this.salesOrderPage) {
                    return 0;
                } else {
                    const people = this.salesOrderPeople;
                    try {
                        return this.calcSumOfProducts(people, 'provision');
                    } catch (error) {
                        console.log(error);
                    }
                }
            },

            totalProvisionOpen() {
                return this.totalExpectedProvision - this.compensation.totalProvisionPaid;
            },

            compensationToBePaid() {
                return (this.compensation.totalSalesCompensation * this.compensation.payoutRate) / 100;
            }
        },

        data() {
            return {
                search: null,
                salesOrdersIdsList: [],

            }
        },

        validations() {
            if(this.salesOrderPage) {
                return {
                    compensation: {
                        salesCompensationFeedback: {
                            required
                        },
                        insuranceId: {
                            required
                        }
                    }
                }
            } else {
                return {
                    search: {
                        required,
                        minValue: minValue(1)
                    },
                    compensation: {
                        salesCompensationFeedback: {
                            required
                        },
                        insuranceId: {
                            required
                        },
                        salesOrder: {
                            id: {
                                required
                            }
                        }
                    }
                }
            }
        },

        methods: {
            ...mapActions('compensations',[
                'fetchCompensation',
                'store',
                'update'
            ]),
            ...mapMutations('compensations', [
                'setSalesOrderId',
                'setTotalSalesCompensations'
            ]),

            /**
             * 
             * @param 
             */
            calcSumOfProducts(people, provisionOrCompensation) {
                let sum = 0;
                if(people !== null) {
                    people.forEach(person => {
                        const products = person.products;
                        if(products.length !== 0) {
                            products.forEach(product => {
                                sum += product[provisionOrCompensation];
                            });
                        };
                    });

                    return sum;
                } else {
                    return 0;
                }
            },

            fetchSalesOrders(search, loading) {
                // we want to vaidate that search is a numeric value
                this.search = search;
                this.$v.search.$touch();
                if(!this.$v.search.$invalid) {
                    loading(true); 
                    axios.get(`/api/sales-orders/${search}`)
                        .then(response => {
                            // we reset the list before adding a new item(s)
                            this.salesOrdersIdsList = [];
                            this.salesOrdersIdsList.push(response.data.salesOrder.id);
                            this.compensation.salesOrder.people = response.data.salesOrder.people;
                            loading(false);
                        }).catch(e => {
                            loading(false);
                        });
                }
            },

            /** 
             * When working with vuex
             * we cant mutate the state directly 
             * so we trigger an action to do it
            */
            setSelected(value) {
                if(value !== undefined && value !== null && value !== '') {
                    this.setSalesOrderId(value);
                    this.$v.$reset(); // reset the validation
                } else { 
                    this.setSalesOrderId(null);
                    this.$v.$reset(); // reset the validation
                }
            },

            /**
             * handle the submitting of the data
             */
            submit() {
                this.$v.compensation.$touch();
                if(!this.$v.compensation.$invalid) {
                    if(this.compensation.id === null) {
                        this.store();
                    } else {
                        this.update();
                    }
                }
            }
        },

        mounted() {
            if(this.compensation.id !== null || this.salesOrderPage === true) {
                this.fetchCompensation();
            }
        },
    }
</script>

<style lang="sass" scoped>

// h4 
//     color: #344055

.toggle-button-wrapper 
    margin-top: 0.9em


.v-select 
    padding-top: 6px 

</style>