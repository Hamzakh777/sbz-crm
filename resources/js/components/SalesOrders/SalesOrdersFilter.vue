<template>
  <div class="filter-form">
    <form id="form">
      <div class="row">
        <!-- sales date from -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.sales_date_from')}}</label>
          <Datepicker
            class="datePicker"
            input-class="form-control"
            v-model="salesDateFrom"
            :format="dateFormat"
          ></Datepicker>
        </div>

        <!-- sales date to -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.sales_date_to')}}</label>
          <Datepicker
            class="datePicker"
            input-class="form-control"
            v-model="salesDateTo"
            :format="dateFormat"
          ></Datepicker>
        </div>

        <!-- sales order status -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.sales_order_status')}}</label>
          <select
            class="form-control"
            name="wanted_expert"
            aria-hidden="true"
            v-model="salesOrderStatus"
          >
            <option disabled value selected>Please select one</option>
            <slot name="sales-statuses"></slot>
          </select>
        </div>

        <!-- Insurance status -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.insurance_status')}}</label>
          <select class="form-control" name="canton" aria-hidden="true" v-model="insuranceStatus">
            <option disabled value selected>Please select one</option>
            <slot name="insurance-statuses"></slot>
          </select>
        </div>

        <!-- sales  -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.sales')}}</label>
          <select
            class="form-control"
            aria-hidden="true"
            v-model="salesUserId"
          >
            <option disabled value selected>Please select one</option>
            <slot name="sales-users"></slot>
          </select>
        </div>

        <!-- Insurance -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.insurance')}}</label>
          <select
            class="form-control"
            aria-hidden="true"
            v-model="insuranceId"
          >
            <option disabled value selected>Please select one</option>
            <slot name="insurances"></slot>
          </select>
        </div>

        <!-- Contract start year -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.contract_start_year')}}</label>
          <select 
            v-model="contractStartYear" 
            class="form-control"
          >
            <option value="2019">2020</option>
            <option value="2019">2019</option>
            <option value="2019">2018</option>
            <option value="2019">2017</option>
            <option value="2019">2016</option>
          </select>
        </div>

        <!-- Sales order completed -->
        <div class="form-group col-md-4">
          <label class="control-label">{{ trans.get('voyager.sales_orders.sales_order_completed')}}</label>
          <div>
            <toggle-button
              v-model="salesOrderCompleted"
              :value="false"
              :labels="{checked: 'yes', unchecked: 'no'}"
            />
          </div>
        </div>
      </div>
      <div class="row pr-2">
        <button class="btn btn-light pull-right" @click.prevent="clearForm">
          <i class="voyager-trash"></i>
          <!-- clear filter -->
          <span>{{ trans.get('voyager.generic.clear_filter') }}</span>
        </button>
        <button class="btn btn-primary pull-right" @click.prevent="filterSalesOrders($data)">
          <i class="voyager-search"></i>
          <!-- filter results -->
          <span>{{ trans.get('voyager.generic.filter') }}</span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { ToggleButton } from "vue-js-toggle-button";
import { mapActions } from "vuex";

export default {
  name: "SalesOrdersFilter",

  components: {
    Datepicker,
    ToggleButton
  },

  data() {
    return {
        salesDateFrom: null,
        salesDateTo: null,
        salesOrderStatus: null,
        insuranceStatus: null,
        salesUserId: null,
        insuranceId: null,
        contractStartYear: null,
        salesOrderCompleted: false,
        dateFormat: "dd MM yyyy"
    };
  },

  methods: {
    ...mapActions(["filterSalesOrders"]),

    clearForm() {
      this.salesDateFrom = null,
      this.salesDateTo = null,
      this.salesOrderStatus = null,
      this.insuranceStatus = null,
      this.salesUserId = null,
      this.insuranceId = null,
      this.contractStartYear = null,
      this.salesOrderCompleted = false,
      this.callDateStart = null;
    }
  }
};
</script>

<style lang="sass">
.filter-form
    margin-top: 1.6em

    .btn 
        margin-left: 1em 

    .pr-2 
        padding-right: 1em

    .datePicker--input , .datePicker--input[readonly]
      color: #76838f
      background-color: #fff !important
      background-image: none
      border: 1px solid #e4eaec

</style>
