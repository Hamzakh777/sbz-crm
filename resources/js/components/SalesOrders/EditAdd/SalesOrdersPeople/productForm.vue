<template>
    <div>
        <form class="row" @submit.prevent="addProduct">
            <div class="form-group col-md-6">
                <label class="control-label">{{ trans.get('voyager.sales_orders.select_product') }}</label>
                <select 
                    class="form-control"
                    v-model="product"
                    :class="{'form-control--error': $v.contractPersonDetails.selectedProduct.$error }"
                >
                    <option 
                        v-for="product in allProducts" 
                        :value="product" 
                        :key="product.id"
                    >
                        {{ product.name }}
                    </option>
                </select>
                <div v-if="$v.contractPersonDetails.selectedProduct.$dirty">
                    <span class="error-text" v-if="!$v.contractPersonDetails.selectedProduct.required">
                        {{ trans.get('validation_js.required') }}
                    </span>
                </div>
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
                    type="submit"
                >
                    <i class="voyager-plus"></i>
                    <span>{{ trans.get('voyager.sales_orders.add_product') }}</span>
                </button>
            </div>
        </form>
        <!-- row to show the already added products -->
        <div class="row">
            <productCard
                v-for="(product, index) in contractPersonDetails.products"
                :key="index"
                :product="product"
                :index="index"
                @delete="deleteProduct"
            >
            </productCard>
        </div>
    </div>
</template>

<script>
    import { required } from 'vuelidate/lib/validators';
    import productCard from './productCard';

    export default {
        name: 'productFrom',
        
        components: {
            productCard
        },

        computed: {
            ...mapGetters(['allProducts', 'salesOrder', 'contractPersonDetails']),

            totalProvision() {
                let sum = 0;
                this.contractPersonDetails.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            }
        },

        data() {
            return {
                product: null,
            }
        },

        validations: {
            contractPersonDetails: {
                selectedProduct: {
                    required
                }
            }
        },

        methods: {
            addProduct() {
                this.$v.$touch();
                if(this.$v.$invalid) {
                    console.log('not validated yet')
                } else {
                    this.$emit('addProduct', this.product);
                }
            },
        },
    }
</script>

<style lang="sass" scoped>
.form-data
    display: block
    padding-left: 1em
    font-size: 18px
    min-height: 26px
    color: #58595f
    max-width: 100%
</style>