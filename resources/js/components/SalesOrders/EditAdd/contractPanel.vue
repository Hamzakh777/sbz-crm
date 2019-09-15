<template>
    <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-company"></i>{{ trans.get('voyager.sales_orders.contract') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <baseLoader v-if="Loading">
            </baseLoader>
            <!-- customer details -->
            <div class="row">
                <h4>{{ trans.get('voyager.sales_orders.customer_details') }}</h4>

                <!-- current insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.current_insurance') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.currentInsuranceId"
                        :class="{'form-control--error': $v.salesOrder.currentInsuranceId.$error }"
                    >
                        <option 
                            v-for="insurance in allInsurances" 
                            :value="insurance.id" 
                            :key="insurance.id"
                        >
                        {{ insurance.name }}
                        </option>
                    </select>
                    <div v-if="$v.salesOrder.currentInsuranceId.$error">
                        <span class="error-text" v-if="!$v.salesOrder.currentInsuranceId.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- full name -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.full_name') }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="salesOrder.fullName"
                        :class="{'form-control--error': $v.salesOrder.fullName.$error }"
                    >
                    <div v-if="$v.salesOrder.fullName.$error">
                        <span class="error-text" v-if="!$v.salesOrder.fullName.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- address  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.generic.address') }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="salesOrder.address"
                        :class="{'form-control--error': $v.salesOrder.address.$error }"
                    >
                    <div v-if="$v.salesOrder.address.$error">
                        <span class="error-text" v-if="!$v.salesOrder.address.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>
                
                <!-- household type -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.household_type') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.householdType"
                        :class="{'form-control--error': $v.salesOrder.householdType.$error }"
                    >
                        <option value="single">{{ trans.get('voyager.sales_orders.single') }}</option>
                        <option value="family">{{ trans.get('voyager.sales_orders.family') }}</option>
                    </select>
                    <div v-if="$v.salesOrder.householdType.$error">
                        <span class="error-text" v-if="!$v.salesOrder.householdType.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- number of family members in the same household  -->
                <div class="form-group col-md-4" v-if="isHouseholdTypeFamily">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.number_of_f_members') }}</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        v-model.trim="salesOrder.numberOfFamilyMembers"
                        :class="{'form-control--error': $v.salesOrder.numberOfFamilyMembers.$error }"
                    >
                    <div v-if="$v.salesOrder.numberOfFamilyMembers.$error">
                        <span class="error-text" v-if="!$v.salesOrder.numberOfFamilyMembers.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- new born  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.new_born') }}</label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.newBorn"
                            :value="salesOrder.newBorn"
                            :sync="true"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>

                <!-- move to switzerland -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.move_to_switzerland') }}</label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.moveToSwitzerland"
                            :value="salesOrder.moveToSwitzerland"
                            :sync="true"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>
            </div>

            <!-- sales details -->
            <div class="row">
                <h4>{{ trans.get('voyager.sales_orders.sales_details') }}</h4>
                <!-- sales lead source  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sales_lead_source') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.salesLeadSource"
                    >
                        <option value="outbound_call">{{ trans.get('voyager.sales_orders.outbound_call') }}</option>
                        <option value="employee_lead">{{ trans.get('voyager.sales_orders.employee_lead') }}</option>
                        <option value="other">{{ trans.get('voyager.generic.other') }}</option>
                    </select>
                </div>
                
                <!-- sales person  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sales_person') }}</label>
                    <!-- load the sales persons using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="salesOrder.salesPersonId"
                        :class="{'form-control--error': $v.salesOrder.salesPersonId.$error }"
                    >
                        <option 
                            v-for="agent in allSalesAgents" 
                            :value="agent.id" 
                            :key="agent.id"
                        >
                            {{ agent.username }}
                        </option>
                    </select>
                    <div v-if="$v.salesOrder.salesPersonId.$error">
                        <span class="error-text" v-if="!$v.salesOrder.salesPersonId.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- sign date -->
                <div class="form-group col-md-4 z-index--101">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sign_date') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.signDate"
                        :format="DateFormat"
                        :class="{'form-control--error': $v.salesOrder.signDate.$error }"
                    ></Datepicker>
                    <div v-if="$v.salesOrder.signDate.$error">
                        <span class="error-text" v-if="!$v.salesOrder.signDate.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- contract details -->
            <div class="row">
                <h4>{{ trans.get('voyager.sales_orders.contract_details') }}</h4>
                <!-- new insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.new_insurance') }}</label>
                    <!-- load the insurances using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="salesOrder.newInsuranceId"
                        :class="{'form-control--error': $v.salesOrder.newInsuranceId.$error }"
                    >
                        <option 
                            v-for="insurance in allInsurances" 
                            :value="insurance.id" 
                            :key="insurance.id"
                        >
                        {{ insurance.name }}
                        </option>
                    </select>
                    <div v-if="$v.salesOrder.newInsuranceId.$error">
                        <span class="error-text" v-if="!$v.salesOrder.newInsuranceId.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- sales order status -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sales_order_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.salesOrderStatus"
                        :class="{'form-control--error': $v.salesOrder.salesOrderStatus.$error }"
                    >
                        <option value="entry">{{ trans.get('voyager.sales_orders.entry') }}</option>
                        <option value="processing">{{ trans.get('voyager.sales_orders.processing') }}</option>
                        <option value="closing">{{ trans.get('voyager.sales_orders.closing') }}</option>
                    </select>
                    <div v-if="$v.salesOrder.salesOrderStatus.$error">
                        <span class="error-text" v-if="!$v.salesOrder.salesOrderStatus.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- Insurance status  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.insurance_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.insuranceStatus"
                        :class="{'form-control--error': $v.salesOrder.insuranceStatus.$error }"
                    >
                        <option value="none">{{ trans.get('voyager.sales_orders.none') }}</option>
                        <option value="submitted">{{ trans.get('voyager.sales_orders.submitted') }}</option>
                        <option value="feedback">{{ trans.get('voyager.sales_orders.feedback') }}</option>
                        <option value="rejected">{{ trans.get('voyager.sales_orders.rejected') }}</option>
                        <option value="approved">{{ trans.get('voyager.sales_orders.approved') }}</option>
                    </select>
                    <div v-if="$v.salesOrder.insuranceStatus.$error">
                        <span class="error-text" v-if="!$v.salesOrder.insuranceStatus.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- insurance details -->
            <div class="row">
                <h4>{{ trans.get('voyager.sales_orders.insurance_details') }}</h4>
                <!-- contract duration VVG  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_duration_VVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.contractDurationVVG"
                        :class="{'form-control--error': $v.salesOrder.contractDurationVVG.$error }"
                    >
                        <option value="60" selected="selected">60</option>
                        <option value="48">48</option>
                        <option value="36">36</option>
                        <option value="24">24</option>
                        <option value="12">12</option>
                    </select>
                    <div v-if="$v.salesOrder.contractDurationVVG.$error">
                        <span class="error-text" v-if="!$v.salesOrder.contractDurationVVG.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- Contract duration KVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_duration_KVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.contractDurationKVG"
                        :class="{'form-control--error': $v.salesOrder.contractDurationKVG.$error }"
                    >
                        <option value="60" selected="selected">60</option>
                        <option value="48">48</option>
                        <option value="36">36</option>
                        <option value="24">24</option>
                        <option value="12">12</option>
                    </select>
                    <div v-if="$v.salesOrder.contractDurationKVG.$error">
                        <span class="error-text" v-if="!$v.salesOrder.contractDurationKVG.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- Contract start VVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_start_VVG') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.contractStartVVG"
                        :format="DateFormat"
                        :class="{'form-control--error': $v.salesOrder.contractStartVVG.$error }"
                    ></Datepicker>
                    <div v-if="$v.salesOrder.contractStartVVG.$error">
                        <span class="error-text" v-if="!$v.salesOrder.contractStartVVG.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- Contract start KVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_start_KVG') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.contractStartKVG"
                        :format="DateFormat"
                        :class="{'form-control--error': $v.salesOrder.contractStartKVG.$error }"
                    ></Datepicker>
                    <div v-if="$v.salesOrder.contractStartKVG.$error">
                        <span class="error-text" v-if="!$v.salesOrder.contractStartKVG.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- Insurance tracking id -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.insurance_tracking_id') }}</label>
                    <input type="text" class="form-control" v-model="salesOrder.insuranceTrackingID">
                </div>
            </div>

            <!-- system details -->
            <div class="row">   
                <h4>{{ trans.get('voyager.sales_orders.system_details') }}</h4>
                <!-- Insurance submitted date  -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.insurance_submitted_date') }}
                    </label>
                    <b v-if="salesOrder.insuranceSubmittedDate">{{ salesOrder.insuranceSubmittedDate | changeDateFormat }}</b>
                    <b v-else>{{ trans.get('voyager.generic.empty') }}</b>
                </div>
            </div>  

            <!-- checkpoint details -->
            <div class="row">   
                <h4>{{ trans.get('voyager.sales_orders.checkpoint_details') }}</h4>
                <!-- Insurance submitted date  -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.cancellation_original') }}
                    </label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.cancellationOriginal"
                            :sync="true"
                            :value="salesOrder.cancellationOriginal"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>
                
                <!-- cancellation stamped -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.cancellation_stamped') }}
                    </label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.cancellationStamped"
                            :sync="true"
                            :value="salesOrder.cancellationStamped"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>

                <!-- provision done -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.provision_done') }}
                    </label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.provisionDone"
                            :sync="true"
                            :value="salesOrder.provisionDone"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>
            </div>  
        </div>
        <div class="panel-footer">
            <div class="row">
                <saveButton @click="submit"></saveButton>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker";
    import saveButton from './saveButton';
    import baseLoader from './../../baseComponents/BaseLoader';
    import { ToggleButton } from "vue-js-toggle-button";
    import { required } from 'vuelidate/lib/validators';
    import {mapGetters, mapActions, mapState} from 'vuex';

    export default {
        name: 'contractPanel',

        components: {
            Datepicker,
            ToggleButton,
            saveButton,
            baseLoader
        },

        watch: {
            'salesOrder.insuranceStatus'(val) {
                if(val === 'submitted') {
                    this.salesOrder.insuranceSubmittedDate = new Date();
                } else {
                    this.salesOrder.insuranceSubmittedDate = null;
                }
            }
        },

        computed: {
            ...mapGetters(['DateFormat', 'allInsurances', 'allSalesAgents', 'salesOrder', 'Loading']),

            isHouseholdTypeFamily() {
                if(this.salesOrder.householdType === 'family') {
                    return true;
                } else {
                    return false;
                }
            }
        },

        validations() {
            if( this.salesOrder.householdType === 'single') {
                return {
                    salesOrder: {
                        currentInsuranceId: {
                            required
                        },
                        newInsuranceId: {
                            required
                        },
                        fullName: {
                            required
                        },
                        address: {
                            required
                        },
                        householdType: {
                            required
                        },
                        salesPersonId: {
                            required
                        },
                        signDate: {
                            required
                        },
                        salesOrderStatus: {
                            required
                        },
                        insuranceStatus: {
                            required
                        },
                        contractDurationVVG: {
                            required
                        },
                        contractDurationKVG: {
                            required
                        },
                        contractStartVVG: {
                            required
                        },
                        contractStartKVG: {
                            required
                        }
                    },
                }
            } else {
                return {
                    salesOrder: {
                        currentInsuranceId: {
                            required
                        },
                        newInsuranceId: {
                            required
                        },
                        fullName: {
                            required
                        },
                        address: {
                            required
                        },
                        householdType: {
                            required
                        },
                        numberOfFamilyMembers: {
                            required
                        },
                        salesPersonId: {
                            required
                        },
                        signDate: {
                            required
                        },
                        salesOrderStatus: {
                            required
                        },
                        insuranceStatus: {
                            required
                        },
                        contractDurationVVG: {
                            required
                        },
                        contractDurationKVG: {
                            required
                        },
                        contractStartVVG: {
                            required
                        },
                        contractStartKVG: {
                            required
                        }
                    },
                }
            }
        },

        mounted() {
            const nextYear = new Date().getFullYear() + 1; 
            const date = new Date(nextYear, 0, 1);
            
            this.salesOrder.contractStartKVG = date;
            this.salesOrder.contractStartVVG = date;

            if(this.salesOrder.id !== null) {
                // fetch the sale order
                this.fetchSalesOrder();
            }
        },

        methods: {
            ...mapActions(['storeSalesOrder', 'fetchSalesOrder', 'updateSalesOrder']),

            submit() {
                this.$v.$touch();
                if(!this.$v.$invalid) {
                    // update
                    if(this.salesOrder.id !== null) {
                        this.updateSalesOrder();
                    // create
                    } else {
                        this.storeSalesOrder();
                    }
                }
            }
        },
    }
</script>

<style lang="sass" scoped>
.toggle-button-wrapper
    margin-top: 1em
.panel-body
    padding: 2em 1em
h4 
    color: #555
    font-weight: bold
    font-size: 16px

.z-index--101
    position: relative
    z-index: 101
</style>