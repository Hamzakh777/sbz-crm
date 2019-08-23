<template>
    <div class="card">
        <div class="card__title">
            <h3>{{ trans.get('voyager.generic.person') }}</h3>
            <div >
                <button class="btn btn-light" v-if="!isEditAdd"> 
                    <i class=""></i>
                    <span>{{ trans.get('voyager.generic.edit') }}</span>
                </button>
                <button class="btn btn-danger" v-if="!isEditAdd"> 
                    <i class="voyager-trash"></i>
                    <span>{{ trans.get('voyager.generic.delete') }}</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <!-- first name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.first_name') }}</label>
                        <input v-if="isEditAdd" type="text" class="form-control" v-model.trim="contractPersonDetails.firstName">
                        <div v-if="$v.contractPersonDetails.firstName.$dirty">
                            <span class="error-text" v-if="!$v.contractPersonDetails.firstName.required">
                                Field is required
                            </span>
                        </div>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.firstName }}
                        </b>
                    </div>

                    <!-- last name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.last_name') }}</label>
                        <input v-if="isEditAdd" type="text" class="form-control" v-model.trim="contractPersonDetails.lastName">
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.lastName }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- Gender -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.gender') }}</label>
                        <select 
                            v-if="isEditAdd"
                            class="form-control"
                            v-model="contractPersonDetails.gender"
                        >
                            <option value="male">
                                {{ trans.get('voyager.generic.male') }}
                            </option>
                            <option value="male">
                                {{ trans.get('voyager.generic.female') }}
                            </option>
                        </select>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.gender }}
                        </b>
                    </div>

                    <!-- birthday -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthday') }}</label>
                        <Datepicker
                            v-if="isEditAdd"
                            class="datePicker"
                            input-class="form-control"
                            v-model="contractPersonDetails.birthday"
                            :format="DateFormat"
                        ></Datepicker>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.birthday }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- birth year -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.generic.birthyear') }}</label>
                        <input v-if="isEditAdd" type="text" class="form-control" v-model.trim="contractPersonDetails.birthyear" readonly>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.birthyear }}
                        </b>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <input v-if="isEditAdd"  type="number" class="form-control" v-model.trim="contractPersonDetails.age" readonly>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.age }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- family member type -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.family_member_type') }}</label>
                        <select
                            v-if="isEditAdd" 
                            class="form-control"
                            v-model.trim="contractPersonDetails.familyMemberType"
                        >
                            <option value="father">
                                {{ trans.get('voyager.generic.father') }}
                            </option>
                            <option value="mother">
                                {{ trans.get('voyager.generic.mother') }}
                            </option>
                            <option value="daughter">
                                {{ trans.get('voyager.generic.daughter') }}
                            </option>
                            <option value="son">
                                {{ trans.get('voyager.generic.son') }}
                            </option>
                            <option value="new_born">
                                {{ trans.get('voyager.generic.new_born') }}
                            </option>
                        </select>
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.familyMemberType }}
                        </b>
                    </div>

                    <!-- police number -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.police_number') }}</label>
                        <input v-if="isEditAdd" type="policeNumber" class="form-control" v-model.trim="contractPersonDetails.policeNumber">
                        <b 
                            class="form-data"
                            v-if="!isEditAdd"
                        >
                            {{ person.policeNumber }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- document id card  -->
                    <div class="form-group col-md-6">
                        here we need to add form upload 
                    </div>
                </div>
            </div>
            <div class="col-md-6 products-col">
                <!-- row to select product -->
                <div class="row" v-if="isEditAdd">
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.select_product') }}</label>
                        <select 
                            class="form-control"
                            v-model="contractPersonDetails.selectedProduct"
                        >
                            <option 
                                v-for="product in allProducts" 
                                :value="product" 
                                :key="product.id"
                            >
                            {{ product.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">
                            {{ trans.get('voyager.sales_orders.total_provision') }}
                        </label>
                        <div><b class="form-data">{{ totalProvision }}</b></div>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-success btn-add-new pull-right"
                            @click.prevent="addProductToContractPerson" >
                            <i class="voyager-plus"></i>
                            <span>{{ trans.get('voyager.sales_orders.add_product') }}</span>
                        </button>
                    </div>
                </div>
                <!-- row to show the already added products -->
                <div class="row">
                    <SalesOrdersPersonProduct
                        v-for="(product, index) in contractPersonDetails.products"
                        :key="index"
                        :product="product"
                    >
                    </SalesOrdersPersonProduct>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
            <button class="btn btn-primary pull-right" @click="submit">
                {{ trans.get('voyager.generic.save') }}
            </button>
        </div>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker";
    import SalesOrdersPersonProduct from './SalesOrdersPersonProduct';
    import { mapGetters, mapActions } from 'vuex';
    import { required } from 'vuelidate/lib/validators'


    export default {
        name: 'SalesOrdersPersonCard',

        components: {
            Datepicker,
            SalesOrdersPersonProduct
        },

        props: {
            isEditAdd: {
                type: Boolean,
                required: true
            },
            person: {
                type: Object
            }
        },
        
        computed: {
            ...mapGetters(['DateFormat', 'salesOrder', 'allInsurances', 'contractPersonDetails', 'allProducts']),

            birthyear() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    return parseInt(date.getYear());
                }
            },

            age() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    const now = new Date();
                    return parseInt(now.getYear()) - parseInt(date.getYear());
                }
            },

            isFamily() {
                if(this.salesOrder.houseHoldType == 'family') {
                    return true;
                } else {
                    return false;
                }
            },

            products() {

            },

            totalProvision() {
                let sum = 0;
                this.contractPersonDetails.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            }
        },

        data() {
            return {
                product: {}
            }
        },

        validations: {
            contractPersonDetails: {
                firstName: {
                    required
                },
                lastName: {
                    required
                },
                gender: {
                    required
                },
                birthday: {
                    required
                }
            }
        },

        methods: {
            ...mapActions(['addContractPerson', 'addProductToContractPerson']),

            submit() {
                console.log('submit');
                this.$v.$touch();
                if(this.$v.$invalid) {
                    console.log('not validated yet')
                } else {
                    this.addContractPerson(this.$data);
                }
            }
        },
    }
</script>

<style lang="sass" scoped>
/* global */
.row 
    padding: 0px 1em

.form-group
    padding-left: 0
    

.form-data
    display: block
    padding-left: 1em
    font-size: 18px
    min-height: 26px
    color: #58595f
    max-width: 100%

.col-md-6
    padding-left: 0

.products-col 
    padding-right: 0
    .row 
        padding-right: 0

/* elt */
.card 
    width: 100%
    border-top: 1px solid #e4eaec
    border-bottom: 1px solid #e4eaec
    // border-radius: 3px
    padding: 2em 1em
    margin-bottom: 3em
    // box-shadow: 0px 26px 34px -19px rgba(0,0,0,0.12)
    box-shadow: none

    &__title
        display: flex
        flex-direction: row
        justify-content: space-between
        margin-bottom: 1em
        padding: 0px 1em

        h3 
            color: #58595f
    
</style>