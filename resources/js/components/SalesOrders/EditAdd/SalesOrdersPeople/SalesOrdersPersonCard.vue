<template>
    <div class="card">
        <div class="row card__title">
            <h3>{{ trans.get('voyager.generic.person') }}</h3>
            <button class="btn btn-danger"> 
                <i class="voyager-trash"></i>
                <span>{{ trans.get('voyager.generic.delete') }}</span>
            </button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <!-- first name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.first_name') }}</label>
                        <input type="text" class="from-control" v-model="firstName">
                    </div>

                    <!-- last name -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.last_name') }}</label>
                        <input type="text" class="from-control" v-model="lastName">
                    </div>

                    <!-- Gender -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.gender') }}</label>
                        <select 
                            class="form-control"
                            v-model="gender"
                        >
                            <option value=""></option>
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
                        <input type="text" class="from-control" v-model="birthyear" readonly>
                    </div>

                    <!-- age -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.generic.age') }}</label>
                        <input type="number" class="from-control" v-model="age">
                    </div>

                    <!-- family member type -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.family_member_type') }}</label>
                        <select 
                            class="form-control"
                            v-model="familyMemberType"
                        >
                            <option value=""></option>
                        </select>
                    </div>

                    <!-- police number -->
                    <div class="form-group col-md-6">
                        <label class="control-label">{{ trans.get('voyager.sales_orders.police_number') }}</label>
                        <input type="policeNumber" class="from-control" v-model="policeNumber">
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
                        <span>{{ trans.get('voyager.sales_orders.') }}</span>
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
            ...mapGetters(['DateFormat']),

            birthyear() {
                if(this.birthday !== null) {
                    const date = new Date(this.birthday);
                    return date.getYear();
                }
            }
        },

        data() {
            return {
                firstName: null,
                lastName: null,
                gender: null,
                birthday: null,
                birthyear: null,
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
    box-shadow: 0px 1px 6px rgba(0,0,0,0.06)

    &__title
        display: flex
        flex-direction: row
        justify-content: spread-between

</style>