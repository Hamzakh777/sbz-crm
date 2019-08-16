<template>
    <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-search"></i>{{ __('voyager::sales_orders.contract') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <div class="row">

                <!-- current insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.current_insurance') }}</label>
                    <!-- load the insurances using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="currentInsuranceId"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- new insurance -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.new_insurance') }}</label>
                    <!-- load the insurances using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="newInsuranceId"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- full name -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_orders.full_name') }}</label>
                    <input type="text" class="form-control" v-model="fullName">
                </div>

                <!-- address  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.generic.address') }}</label>
                    <input type="text" class="form-control" v-model="address">
                </div>
                
                <!-- household type -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.household_type') }}</label>
                    <select 
                        class="form-control"
                        v-model="householdType"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- number of family members in the same household  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.number_of_f_members') }}</label>
                    <input type="number" class="form-control" v-model="numberOfFamilyMembers">
                </div>

                <!-- new born  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.new_born') }}</label>
                    <div>
                        <toggle-button
                            v-model="newBorn"
                            :value="false"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>


                <!-- move to switzerland -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.move_to_switzerland') }}</label>
                    <div>
                        <toggle-button
                            v-model="moveToSwitzerland"
                            :value="false"
                            :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                        />
                    </div>
                </div>

                <!-- sales lead source  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.sales_lead_source') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesLeadSource"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- sales person  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.generic.sales_person') }}</label>
                    <!-- load the sales persons using ajax
                    which means we have to create a route for that -->
                    <select 
                        class="form-control"
                        v-model="salesPersonId"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- sign date -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.sign_date') }}</label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="signDate"
                        :format="dateFormat"
                    ></Datepicker>
                </div>

                <!-- sales order status -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.sales_order_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="salesOrderStatus"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- Insurance status  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.insurance_status') }}</label>
                    <select 
                        class="form-control"
                        v-model="insuranceStatus"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- contract duration VVG  -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.contract_duration__VVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="contractDurationVVG"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- Contract duration KVG -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.contract_duration_KVG') }}</label>
                    <select 
                        class="form-control"
                        v-model="contractDurationKVG"
                    >
                        <option value=""></option>
                    </select>
                </div>

                <!-- Insurance tracking id -->
                <div class="form-group col-md-4">
                    <label class="control-label">{{ trans.get('voyager.sales_ordres.insurance_tracking_id') }}</label>
                    <input type="text" class="form-control" v-model="insuranceTrackingID">
                </div>

                <!-- Insurance submitted date  -->

            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker";
    import { ToggleButton } from "vue-js-toggle-button";

    export default {
        name: 'SalesOrderContractPanel',

        components: {
            Datepicker,
            ToggleButton
        },

        data() {
            return {
                currentInsuranceId: null,
                newInsuranceid: null,
                fullName: null,
                address: null,
                householdType: null,
                numberOfFamilyMembers: null,
                newBorn: null,
                moveToSwitzerland: null,
                salesLeadSource: null,
                salesPersonId: null,
                signDate: null,
                salesOrderStatus: null,
                insuranceStatus: null,
                contractDurationVVG: null,
                contractDurationKVG: null,
                insuranceTrackingID: null,
                
                dateFormat: "dd MM yyyy"
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>