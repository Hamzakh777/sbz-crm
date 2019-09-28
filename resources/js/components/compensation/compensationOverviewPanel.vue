<template>
    <BasePanel
        name="voyager.compensations.compensation_overview"
        icon="voyager-file-text"
        :showFooter="true"
    >
        <template v-slot:body>
            <BaseLoader v-if="isLoading"></BaseLoader>
            <!-- sales agent -->
            <div class="row">
                <h4>{{ trans.get('voyager.compensations.compensation_details') }}</h4>
                <div class="form-group col-sm-4">
                    <label class="control-labe">
                        {{ trans.get('voyager.generic.sales_agent') }}
                    </label>
                    <vSelect 
                        :value="salesAgentUsername"
                        @input="setSelected"
                        label="username"
                        :filterable="true"
                        :options="allSalesAgents"
                        :class="{'v-select--error': $v.periodPlanYear.$error }"
                        >
                    </vSelect>
                    <div v-if="$v.salesAgentId.$error ">
                        <span class="error-text" v-if="!$v.salesAgentId.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>

                <!-- period plan -->
                <div class="form-group col-sm-4">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.period_plan') }}
                    </label>
                    <div class="row period-plan-row">
                        <div class="col-sm-6">
                            <select 
                                class="form-control"
                                v-model="periodPlanMonth"
                                :class="{'form-control--error': $v.periodPlanMonth.$error }"
                            >
                                <option 
                                    v-for="n in 12"
                                    :key="n"
                                    :value="n"
                                >
                                    {{ n }}
                                </option>
                            </select>
                            <div v-if="$v.periodPlanMonth.$error ">
                                <span class="error-text" v-if="!$v.periodPlanMonth.required">
                                    {{ trans.get('validation_js.required') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <select 
                                class="form-control "
                                v-model="periodPlanYear"
                                :class="{'form-control--error': $v.periodPlanYear.$error }"
                            >
                                <option 
                                    v-for="n in periodplanYears"
                                    :key="n"
                                    :value="n">{{ n }}</option>
                            </select>
                            <div v-if="$v.periodPlanYear.$error ">
                                <span class="error-text" v-if="!$v.periodPlanYear.required">
                                    {{ trans.get('validation_js.required') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- payout date -->
                <div class="form-group col-sm-4">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.payout_date') }}
                    </label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="payoutDate"
                        :format="DateFormat"
                        :class="{'form-control--error': $v.payoutDate.$error }"
                    ></Datepicker>
                    <div v-if="$v.payoutDate.$error ">
                        <span class="error-text" v-if="!$v.payoutDate.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4>{{ trans.get('voyager.compensations.company_details') }}</h4>
                <!-- company name -->
                <div class="form-group col-sm-3">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.company_name') }}
                    </label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="companyName"
                    >
                </div>

                <!-- street and number -->
                <div class="form-group col-sm-3">
                    <label class="control-label">
                        {{ trans.get('voyager.compensations.street_and_number') }}
                    </label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="streetAndNumber"
                    >
                </div>

                <!-- zipcode -->
                <div class="form-group col-sm-2">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.zipcode') }}
                    </label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="zipcode"
                    >
                </div>
                
                <!-- city -->
                <div class="from-group col-sm-2">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.city') }}
                    </label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="city"
                    >
                </div>

                <!-- country -->
                <div class="from-group col-sm-2">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.country') }}
                    </label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="country"
                    >
                </div>
            </div>
        </template>

        <template v-slot:footer>
            <div class="row">
                <button     
                    class="btn btn-success pull-right"
                    @click.prevent="submit"    
                >
                    {{ trans.get('voyager.compensations.generate_pdf') }}
                </button>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../baseComponents/BasePanel';
    import BaseLoader from '../baseComponents/BaseLoader';
    import Datepicker from "vuejs-datepicker";
    import {required} from 'vuelidate/lib/validators';
    import vSelect from 'vue-select';
    import {mapGetters} from 'vuex';

    export default {
        name: 'CompensationOverviewPanel',
        
        components: {
            BasePanel,
            BaseLoader,
            vSelect,
            Datepicker
        },

        computed: {
            ...mapGetters(['allSalesAgents', 'DateFormat']),
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
        },

        data() {
            return {
                salesAgentId: null,
                periodPlanMonth: null,
                periodPlanYear: null,
                salesAgentUsername: null,
                isLoading: false,
                payoutDate: null,
                companyName: null,
                streetAndNumber: null,
                zipcode: null,
                city: null,
                country: null
            }
        },

        validations: {
            salesAgentId: {
                required
            }, 
            periodPlanMonth: {
                required
            },
            periodPlanYear: {
                required
            },
            payoutDate: {
                required
            }
        },

        methods: {
            async submit() {
                this.$v.$touch();
                if(!this.$v.$invalid) {
                    this.isLoading = true;
                    try {
                        const salesAgentId = `salesAgentId=${this.salesAgentId}`;
                        const periodPlanMonth = `periodPlanMonth=${this.periodPlanMonth}`;
                        const periodPlanYear = `periodPlanYear=${this.periodPlanYear}`;
                        const payoutDate = `payoutDate=${this.$options.filters.changeDateFormat(this.payoutDate)}`;
                        const companyName = `companyName=${this.companyName}`;
                        const streetAndNumber = `stAndNum=${this.streetAndNumber}`;
                        const zipcode = `zipcode=${this.zipcode}`;
                        const city = `city=${this.city}`;
                        const country = `country=${this.country}`;

                        const url = `compensations/overview?${salesAgentId}&${periodPlanMonth}&${periodPlanYear}&${payoutDate}&${companyName}&${streetAndNumber}&${zipcode}&${city}&${country}`;

                        window.open(url);
                        this.isLoading = false;
                    } catch (error) {
                        this.isLoading = false; 
                        console.log(error);
                    }
                }
            },

            setSelected(value) {
                if(value !== null) {
                    this.salesAgentId = value.id;
                    this.salesAgentUsername = value.username;
                } else {
                    this.salesAgentId = null;
                    this.salesAgentUsername = null;
                }
            }
        },
    }
</script>

<style lang="sass" scoped>
.row>[class*=col-]
    margin-bottom: 15px

h4 
    color: #555
    font-weight: bold
    font-size: 16px

.period-plan-row 
    .col-sm-6 
        @media(max-width: 765px)
            padding: 0 !important
</style>