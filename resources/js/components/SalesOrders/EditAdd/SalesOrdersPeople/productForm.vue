<template>
    <div>
        <div class="row row--no-padding">
            <div class="form-group col-md-6 products-dropdown" v-if="isEditAdd">
                <label class="control-label">{{ trans.get('voyager.sales_orders.select_product') }}</label>
                <select 
                    class="form-control"
                    v-model="product"
                    :class="{'form-control--error': $v.product$error }"
                >
                    <option 
                        v-for="product in allProducts" 
                        :value="product" 
                        :key="product.id"
                    >
                        {{ product.name }}
                    </option>
                </select>
                <div v-if="$v.product.$dirty">
                    <span class="error-text" v-if="!$v.product.required">
                        {{ trans.get('validation_js.required') }}
                    </span>
                </div>
            </div>
            <div class="col-sm-3 form-group total-provision">
                <label class="control-label">
                    {{ trans.get('voyager.sales_orders.total_provision') }}
                </label>
                <div><b class="form-data">{{ totalProvision }}</b></div>
            </div>
            <div class="col-sm-3 pull-right" v-if="isEditAdd">
                <i 
                    @click="addProduct"
                    class="voyager-plus btn--add-product pull-right" 
                >
                </i>
            </div>
        </div>
        <!-- row to show the already added products -->
        <div class="row">
            <p v-if="productsTotal !== 0">{{ trans.get('voyager.sales_orders.added_products') }}</p>
            <productCard
                v-for="(product, index) in products"
                :key="index"
                :product="product"
                :index="index"
                @delete="$emit('deleteProduct', index)"
                :isEditAdd="isEditAdd"
            >
            </productCard>
        </div>
    </div>
</template>

<script>
    import { required } from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';
    import productCard from './productCard';

    export default {
        name: 'productFrom',
        
        components: {
            productCard
        },

        props: {
            products: {
                type: Array, 
                required: false
            },
            isEditAdd: {
                type: Boolean,
                default: true,
            }
        },

        computed: {
            ...mapGetters(['allProducts', 'salesOrder', 'contractPersonDetails']),

            totalProvision() {
                let sum = 0;
                this.products.forEach(product => sum += parseInt(product.provision));
                return sum;
            },
            
            productsTotal() {
                return this.products.length;
            }
        },

        data() {
            return {
                product: null,
            }
        },

        validations: {
            product: {
                required
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

.btn--add-product
    font-size: 36px 
    cursor: pointer

    &:hover 
        color: #2ecc71

.total-provision
    margin-bottom: 10px !important

@media(max-width: 999px)
.total-provision, .products-dropdown
    padding-left: 0 !important

</style>