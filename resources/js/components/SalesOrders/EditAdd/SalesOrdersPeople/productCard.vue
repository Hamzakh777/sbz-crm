<template>
    <div class="product-card">
        <div class="row">
            <div class="col-md-4">
                {{product.name}}
            </div>
            <div class="col-md-4">
                {{ category.name }}
            </div>
            <div class="col-md-3">
                {{ product.provision ?  `${product.provision} chf`: '' }}  
            </div>
            <div class="col-md-1">
                <i 
                    class="voyager-trash"
                    @click="removeProduct(id)"
                ></i>
            </div>

        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: 'productCard',

        props: {
            product: {
                type: Object,
                required: true
            }
        },

        computed: {
            ...mapGetters(['allProductCategories']),
            id() {
                return this.product.id;
            },
            category() {
                // some products might not have a category assigned yet
                if(this.product.products_category_id !== null) {
                    return _.find(this.productCategories, (o) => o.id === this.product.products_category_id);
                } else {
                    return {
                        name: 'No category'
                    }
                }
            }
        },

        methods: {
            ...mapActions(['removeProduct'])
        },
    }
</script>

<style lang="sass" scoped>
.product-card
    background-color: #fff
    box-shadow: 0px 6px 20px rgba(0,0,0,0.07)
    border-left: 2px solid #4E73DF
    padding: 1.4em 0.6em 1em 0.6em
    margin-bottom: 1em

    .row>[class*=col-]
        margin-bottom: 0

    .voyager-trash
        cursor: pointer
        display: block
        margin-top: -3px
        font-size: 20px

        &:hover
            color: #FB4027
</style>