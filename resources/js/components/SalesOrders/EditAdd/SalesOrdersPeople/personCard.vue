<template>
    <div class="card">
        <div class="card__title">
            <h3>{{ trans.get('voyager.generic.person') }}</h3>
            <div >
                <!-- <button class="btn btn-light"> 
                    <i class=""></i>
                    <span>{{ trans.get('voyager.generic.edit') }}</span>
                </!--> -->
                <button class="btn btn-danger"> 
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
                        <b 
                            class="form-data"
                        >
                            {{ person.firstName }}
                        </b>
                    </div>

                    <!-- last name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.last_name') }}</label>
                        <b 
                            class="form-data" 
                        >
                            {{ person.lastName }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- Gender -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.gender') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ person.gender }}
                        </b>
                    </div>

                    <!-- birthday -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthday') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ person.birthday }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- birth year -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.generic.birthyear') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ person.birthyear }}
                        </b>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ person.age }}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- family member type -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.family_member_type') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ person.familyMemberType }}
                        </b>
                    </div>

                    <!-- police number -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.police_number') }}</label>
                        <b 
                            class="form-data"
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
                <!-- <productForm 
                    v-if="isEditAdd"
                >
                </productForm> -->
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
    import productCard from './productCard';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: 'SalesOrdersPersonCard',

        components: {
            productForm,
        },

        props: {
            person: {
                type: Object
            }
        },
        
        computed: {
            ...mapGetters(['DateFormat', 'salesOrder', 'allInsurances', 'allProducts']),

            birthyear() {
                if(this.person.birthday !== null) {
                    const date = new Date(this.person.birthday);
                    return parseInt(date.getYear());
                }
            },

            age() {
                if(this.person.birthday !== null) {
                    const date = new Date(this.person.birthday);
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

            totalProvision() {
                let sum = 0;
                this.person.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            }
        },

        methods: {
            ...mapActions('salesOrdersPeople', ['deletePerson']),

            delete() {
                this.deletePerson(this.person.id);
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