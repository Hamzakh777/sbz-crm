<template>
    <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-company"></i>{{ trans.get('voyager.sales_orders.contract') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <div class="row">

                <!-- current insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.current_insurance') }}</label>
                    <!-- load the insurances using ajax
                    which means we have to create a route for that -->
                    <!-- or maybe instead of using ajax, we can server render that variable -->
                    <select 
                        class="form-control"
                        v-model="salesOrder.currentInsuranceId"
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

                <!-- new insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.new_insurance') }}</label>
                    <!-- load the insurances using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="salesOrder.newInsuranceId"
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

                <!-- full name -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.full_name') }}</label>
                    <input type="text" class="form-control" v-model="salesOrder.fullName">
                </div>

                <!-- address  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.generic.address') }}</label>
                    <input type="text" class="form-control" v-model="salesOrder.address">
                </div>
                
                <!-- household type -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.household_type') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.householdType"
                    >
                        <option value="single">{{ trans.get('voyager.generic.single') }}</option>
                        <option value="family">{{ trans.get('voyager.generic.family') }}</option>
                    </select>
                </div>

                <!-- number of family members in the same household  -->
                <div class="form-group col-md-4" v-if="isHouseholdTypeFamily">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.number_of_f_members') }}</label>
                    <input type="number" class="form-control" v-model.trim="salesOrder.numberOfFamilyMembers">
                </div>
                <!-- new born  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.new_born') }}</label>
                    <div class="toggle-button-wrapper">
                        <toggle-button
                            v-model="salesOrder.newBorn"
                            :value="false"
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
                            :value="false"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>

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
                    >
                        <option 
                            v-for="agent in allSalesAgents" 
                            :value="agent.id" 
                            :key="agent.id"
                        >
                            {{ agent.username }}
                        </option>
                    </select>
                </div>

                <!-- sign date -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sign_date') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.signDate"
                        :format="DateFormat"
                    ></Datepicker>
                </div>

                <!-- sales order status -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.sales_order_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.salesOrderStatus"
                    >
                        <option value="entry">{{ trans.get('voyager.sales_orders.entry') }}</option>
                        <option value="processing">{{ trans.get('voyager.sales_orders.processing') }}</option>
                        <option value="closing">{{ trans.get('voyager.sales_orders.closing') }}</option>
                    </select>
                </div>
                <!-- Insurance status  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.insurance_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.insuranceStatus"
                    >
                        <option value="">{{ trans.get('voyager.sales_orders.none') }}</option>
                        <option value="submitted">{{ trans.get('voyager.sales_orders.submitted') }}</option>
                        <option value="feedback">{{ trans.get('voyager.sales_orders.feedback') }}</option>
                        <option value="rejected">{{ trans.get('voyager.sales_orders.rejected') }}</option>
                        <option value="approved">{{ trans.get('voyager.sales_orders.approved') }}</option>
                    </select>
                </div>

                <!-- contract duration VVG  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_duration_VVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.contractDurationVVG"
                    >
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                        <option value="48">48</option>
                        <option value="60" selected>60</option>
                    </select>
                </div>

                <!-- Contract duration KVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_duration_KVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrder.contractDurationKVG"
                    >
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                        <option value="48">48</option>
                        <option value="60" selected>60</option>
                    </select>
                </div>

                <!-- Contract start VVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_start_VVG') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.contractStartVVG"
                        :format="DateFormat"
                    ></Datepicker>
                </div>

                <!-- Contract start KVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.contract_start_KVG') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="salesOrder.contractStartKVG"
                        :format="DateFormat"
                    ></Datepicker>
                </div>

                <!-- Insurance tracking id -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.insurance_tracking_id') }}</label>
                    <input type="text" class="form-control" v-model="salesOrder.insuranceTrackingID">
                </div>

                <!-- Insurance submitted date  -->
                <div class="form-group col-md-4">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.insurance_submitted_date') }}
                    </label>
                    <b v-if="!salesOrder.insuranceSubmittedDate">{{ }}</b>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker";
    import { ToggleButton } from "vue-js-toggle-button";

    import {mapGetters} from 'vuex';

    export default {
        name: 'SalesOrderContractPanel',

        components: {
            Datepicker,
            ToggleButton
        },

        watch: {
            salesOrder: {
                insuranceStatus(val, oldVal) {
                    
                }
            }
        },

        computed: {
            ...mapGetters(['DateFormat', 'allInsurances', 'allSalesAgents', 'salesOrder']),

            isHouseholdTypeFamily() {
                if(this.salesOrder.householdType === 'family') {
                    return true;
                } else {
                    return false;
                }
            }
        },

        mounted() {
            const nextYear = new Date().getFullYear() + 1; 
            const date = new Date(nextYear, 0, 1);
            
            this.salesOrder.contractStartKVG = date;
            this.salesOrder.contractStartVVG = date;
        }
    }
</script>

<style lang="sass" scoped>
.toggle-button-wrapper
    margin-top: 1em
.panel-body
    padding: 2em 1em
</style>