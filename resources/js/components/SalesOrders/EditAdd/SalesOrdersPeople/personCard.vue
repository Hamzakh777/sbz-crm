<template>
    <div class="card">
        <div class="card__title">
            <h3>{{ trans.get('voyager.generic.person') + ' ' + index }}</h3>
            <div >
                <!-- <button class="btn btn-light"> 
                    <i class=""></i>
                    <span>{{ trans.get('voyager.generic.edit') }}</span>
                </!-->
                    <i 
                        @click="deletePerson(person.id)"
                        class="voyager-trash card__action--delete">
                    </i>
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
                            {{ person.birthday | changeDateFormat}}
                        </b>
                    </div>
                </div>

                <div class="row">
                    <!-- birth year -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthyear') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ birthyear }}
                        </b>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <b 
                            class="form-data"
                        >
                            {{ age }}
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
                        Here we probably need a download button
                    </div>
                </div>
            </div>
            <div class="col-md-6 products-col">
                <!-- row to select product -->
                <productForm 
                    :isEditAdd="false"
                    :products="person.products"
                >
                </productForm>
            </div>
        </div>
    </div>
</template>

<script>
    import productCard from './productCard';
    import productForm from './productForm';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: 'SalesOrdersPersonCard',

        components: {
            productForm,
        },

        props: {
            person: {
                type: Object
            },
            index: {
                type: Number,
            }
        },
        
        computed: {
            ...mapGetters(['salesOrder', 'allProducts']),

            birthyear() {
                if(this.person.birthday !== null) {
                    const date = new Date(this.person.birthday);
                    return parseInt(date.getFullYear());
                }
            },

            age() {
                if(this.person.birthday !== null) {
                    const date = new Date(this.person.birthday);
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
                this.person.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            }
        },

        methods: {
            ...mapActions('salesOrdersPeople', ['deletePerson']),
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

    &__action
        &--delete
            font-size: 20px
            cursor: pointer

            &:hover
                color: #fa2a00
    
</style>