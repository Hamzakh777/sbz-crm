<template>
    <BasePanel
        name="voyager.compensations.compensation_overview"
        icon="voyager-file-text"
        :showFooter="true"
    >
        <template v-slot:body>
            <BaseLoader v-if="isLoading"></BaseLoader>
            <!-- sales agent -->
            <div class="form-group col-md-4">
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
            <div class="form-group col-md-4">
                <label class="control-label">
                    {{ trans.get('voyager.compensations.period_plan') }}
                </label>
                <div class="row">
                    <div class="col-md-6">
                        <select 
                            class="form-control "
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
                    <div class="col-md-6">
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

            <!-- we also need a way to show error messages in case there is not data to generate the compensation -->
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
    import {required} from 'vuelidate/lib/validators';
    import vSelect from 'vue-select';
    import {mapGetters} from 'vuex';

    export default {
        name: 'CompensationOverviewPanel',
        
        components: {
            BasePanel,
            BaseLoader,
            vSelect
        },

        computed: {
            ...mapGetters(['allSalesAgents']),
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
                isLoading: false
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
                        const url = `compensations/overview?${salesAgentId}&${periodPlanMonth}&${periodPlanYear}`;

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

</style>