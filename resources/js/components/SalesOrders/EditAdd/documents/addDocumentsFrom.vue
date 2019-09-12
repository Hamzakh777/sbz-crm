<template>
<form @submit.prevent="submit">
    <div class="row">
        <div class="form-gorup col-md-4">
            <label class="control-label">{{ trans.get('voyager.sales_orders.document_name') }}</label>
            <input 
                type="text" 
                v-model="name" 
                class="form-control"
                :class="{'form-control--error': $v.name.$error }"
            >
            <div v-if="$v.name.$error">
                <span class="error-text" v-if="!$v.name.required">
                    {{ trans.get('validation_js.required') }}
                </span>
            </div>
        </div>
        <div class="form-gorup col-md-4">
            <label class="control-label">{{ trans.get('voyager.sales_orders.document_type') }}</label>
            <select  
                class="form-control"
                v-model="type"
                :class="{'form-control--error': $v.type.$error }"
            >
                <option value="id_card">{{ trans.get('voyager.sales_orders.id_card') }}</option>
                <option value="contract_termination_original">{{ trans.get('voyager.sales_orders.contract_termination_original') }}</option>
                <option value="contract_termination_stamped">{{ trans.get('voyager.sales_orders.contract_termination_stamped') }}</option>
                <option value="other">{{ trans.get('voyager.sales_orders.other') }}</option>
            </select>
            <div v-if="$v.type.$error">
                <span class="error-text" v-if="!$v.type.required">
                    {{ trans.get('validation_js.required') }}
                </span>
            </div>
        </div>
        <div class="form-gorup col-md-4">
            <label class="control-label">{{ trans.get('voyager.sales_orders.document_status') }}</label>
            <select  
                class="form-control"
                v-model="status"
                :class="{'form-control--error': $v.status.$error }"
            >
                <option value="open">{{ trans.get('voyager.generic.open') }}</option>
                <option value="closed">{{ trans.get('voyager.generic.closed') }}</option>
            </select>
            <div v-if="$v.status.$error">
                <span class="error-text" v-if="!$v.status.required">
                    {{ trans.get('validation_js.required') }}
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <input type="file" class="btn btn-primary" v-on:change="onFileChange">
        </div>
        <div class="col-md-4 pull-right">
            <button class="btn btn-success pull-right"
                type="submit"
            >
                {{ trans.get('voyager.generic.add') }}
            </button>
        </div>
    </div>
</form>
</template>

<script>
    import { required } from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';
    
    export default {
        name: 'addDocumentsForm',

        validations: {
            name: {
                required
            },
            type: {
                required
            },
            status: {
                required
            }
            // we dont know if a file is required or not
        },

        computed: {
            ...mapGetters(['salesOrder']),
        },

        data() {
            return {
                id: null,
                name: null,
                type: null,
                status: null,
                file: null
            }
        },

        methods: {
            submit() {
                this.$v.$touch();
                if(!this.$v.$invalid) {
                    let formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('name', this.name);
                    formData.append('type', this.type);
                    formData.append('status', this.status);
                    formData.append('status', this.status);
                    formData.append('salesOrderId', this.salesOrder.id);
                    
                    this.$emit('storeDocument', formData);
                } 
            },

            onFileChange(e) {
                this.file = e.target.files[0];
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>