<template>
    <div class="card">
        <div class="card__title">
            <h3>{{ trans.get('voyager.generic.person') }}</h3>
            <div class="">
                <button class="btn btn-light"> 
                    <i class=""></i>
                    <span>{{ trans.get('voyager.generic.edit') }}</span>
                </button>
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
                        <input type="text" class="form-control" v-model="firstName">
                    </div>

                    <!-- last name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.last_name') }}</label>
                        <input type="text" class="form-control" v-model="lastName">
                    </div>

                    <!-- Gender -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.gender') }}</label>
                        <select 
                            class="form-control"
                            v-model="gender"
                        >
                            <option value="male">
                                {{ trans.get('voyager.generic.male') }}
                            </option>
                            <option value="male">
                                {{ trans.get('voyager.generic.female') }}
                            </option>
                        </select>
                    </div>

                    <!-- birthday -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthday') }}</label>
                        <Datepicker
                            class="datePicker"
                            input-class="form-control"
                            v-model="birthday"
                            :format="DateFormat"
                        ></Datepicker>
                    </div>

                    <!-- birth year -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.birthyear') }}</label>
                        <input type="text" class="form-control" v-model="birthyear" readonly>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <input type="number" class="form-control" v-model="age">
                    </div>

                    <!-- family member type -->
                    <div class="form-group col-md-6" v-if="isFamily">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.family_member_type') }}</label>
                        <select 
                            class="form-control"
                            v-model="familyMemberType"
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
                        <input type="policeNumber" class="form-control" v-model="policeNumber">
                    </div>

                    <!-- document id card  -->
                    <div class="form-group col-md-6">
                        here we need to add form upload 
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <button
                        class="btn btn-success btn-add-new pull-right"
                    >
                        <i class="voyager-plus"></i>
                        <span>{{ trans.get('voyager.sales_orders.add_product') }}</span>
                    </button>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker";

    import { mapGetters } from 'vuex';

    export default {
        name: 'SalesOrdersPersonCard',

        components: {
            Datepicker
        },
        
        computed: {
            ...mapGetters(['DateFormat', 'salesOrder']),

            birthyear() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    return date.getYear();
                }
            },

            isFamily() {
                if(this.salesOrder.houseHoldType == 'family') {
                    return true;
                } else {
                    return false;
                }
            }
        },

        data() {
            return {
                firstName: null,
                lastName: null,
                gender: null,
                birthday: null,
                age: null,
                familyMemberType: null,
                policeNumber: null
            }
        },
    }
</script>

<style lang="sass" scoped>

.card 
    width: 100%
    border: 1px solid #e4eaec
    border-radius: 6px
    padding: 1.5em 0

    &__title
        display: flex
        flex-direction: row
        justify-content: space-between
        margin-bottom: 1em
        padding: 0px 1em
</style>