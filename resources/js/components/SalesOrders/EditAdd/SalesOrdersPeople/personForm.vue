<template>
    <div class="card">
        <div class="card__title">
            <h3>{{ trans.get('voyager.generic.person') }}</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <!-- first name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.first_name') }}</label>
                        <input  type="text" class="form-control" :class="{'form-control--error': $v.firstName.$error }" v-model.trim="firstName">
                        <div v-if="$v.firstName.$error">
                            <span class="error-text" v-if="!$v.firstName.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
                    </div>

                    <!-- last name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.last_name') }}</label>
                        <input 
                             
                            type="text" 
                            class="form-control" 
                            :class="{'form-control--error': $v.lastName.$error }"
                            v-model.trim="lastName">
                        <div v-if="$v.lastName.$error">
                            <span class="error-text" v-if="!$v.lastName.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Gender -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.gender') }}</label>
                        <select 
                            
                            class="form-control"
                            v-model="gender"
                            :class="{'form-control--error': $v.gender.$error }"
                        >
                            <option value="male">
                                {{ trans.get('voyager.generic.male') }}
                            </option>
                            <option value="male">
                                {{ trans.get('voyager.generic.female') }}
                            </option>
                        </select>
                        <div v-if="$v.gender.$error">
                            <span class="error-text" v-if="!$v.gender.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
                    </div>

                    <!-- birthday -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthday') }}</label>
                        <Datepicker
                            class="datePicker"
                            input-class="form-control"
                            v-model="birthday"
                            :format="DateFormat"
                            :class="{'form-control--error': $v.birthday.$error }"
                        ></Datepicker>
                        <div v-if="$v.birthday.$error">
                            <span class="error-text" v-if="!$v.birthday.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- birth year -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthyear') }}</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            v-model.trim="birthyear" 
                            readonly>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <input
                            type="number" 
                            class="form-control" 
                            v-model.trim="age" 
                            :class="{'form-control--error': $v.age.$error }"
                            readonly>
                        <div v-if="$v.age.$error">
                            <span class="error-text" v-if="!$v.age.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- family member type -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.family_member_type') }}</label>
                        <select
                             
                            class="form-control"
                            v-model.trim="familyMemberType"
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
                    </div>

                    <!-- police number -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.police_number') }}</label>
                        <input  type="policeNumber" class="form-control" v-model.trim="policeNumber">
                    </div>
                </div>

                <div class="row">
                    <!-- document id card  -->
                    <div class="form-group col-md-6">
                        <input type="file" class="btn btn-primary" v-on:change="onFileChange">
                    </div>
                </div>
            </div>
            <div class="col-md-6 products-col">
                <!-- row to select product -->
                <productForm 
                    @addProduct="addProduct"
                    @deleteProduct="deleteProduct"
                    :products="products"
                >
                </productForm>
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
    import productCard from './productCard';
    import { mapGetters, mapActions } from 'vuex';
    import { required } from 'vuelidate/lib/validators';
    import productForm from './productForm.vue';


    export default {
        name: 'personForm',

        components: {
            Datepicker,
            productForm,
            productCard
        },

        computed: {
            ...mapGetters(['DateFormat', 'salesOrder', 'allInsurances', 'allProducts']),

            birthyear() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    return parseInt(date.getFullYear());
                }
            },

            age() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    const now = new Date();
                    return parseInt(now.getFullYear()) - parseInt(date.getFullYear());
                }
            },

            isFamily() {
                if(this.salesOrder.houseHoldType == 'family') {
                    return true;
                } else {
                    return false;
                }
            },

            totalProvision() {
                let sum = 0;
                this.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            }
        },

        data() {
            return {
                firstName: null,
                lastName: null,
                gender: null,
                birthday: null,
                familyMemberType: null,
                policeNumber: null,
                documentIdCard: null,
                products: []
            }
        },

        validations: {
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
            },
            birthday: {
                required
            },
            age: {
                required
            }
            // we also need some validation for the upload part
        },

        methods: {
            ...mapActions('salesOrdersPeople', ['addPerson']),

            submit() {
                this.$v.$touch();
                if(!this.$v.$invalid) {
                    let formData = new FormData();
                    formData.append('firstName', this.firstName);
                    formData.append('lastName', this.lastName);
                    formData.append('gender', this.gender);
                    formData.append('birthday', this.birthday);
                    formData.append('age', this.age);
                    formData.append('familyMemberType', this.familyMemberType);
                    formData.append('policeNumber', this.policeNumber);
                    formData.append('products', JSON.stringify(this.products));
                    formData.append('salesOrderId', this.salesOrder.id);
                    formData.append('documentIdCard', this.documentIdCard);

                    this.addPerson(
                        formData
                    );
                }
            },

            addProduct(product) {
                this.products.unshift(product);
            },

            deleteProduct(index){
                this.products = this.products.filter((product, prodIndex) => prodIndex !== index);
            },

            onFileChange(e) {
                this.documentIdCard = e.target.files[0];
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

.col-md-6
    padding-left: 0

.products-col 
    padding-right: 0
    .row 
        padding-right: 0

/* elt */
.card 
    width: 100%
    border: 1px solid #e4eaec
    // border: 1px solid #e4eaec
    // border-radius: 3px
    padding: 2em 1em
    margin-bottom: 2em
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