<template>
    <div class="product-card">
        <div class="row">
            <div class="col-sm-4">
                {{ trans.get('voyager.product.name') }}: <b>{{product.name}}</b>
            </div>
            <div class="col-sm-4">
                {{trans.get('voyager.generic.category')}}: <b>{{ category.name }}</b>
            </div>
            <div class="col-sm-3" :class="{'col-md-4': !isEditAdd}">
                {{ trans.get('voyager.product.provision') }} <b>{{ product.provision ?  `${product.provision} chf`: '' }}  </b>
            </div>
            <div class="col-1" v-if="isEditAdd">
                <i 
                    class="voyager-trash"
                    
                    @click="$emit('delete', index)"
                ></i>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'productCard',

        props: {
            product: {
                type: Object,
                required: true
            },
            index: {
                type: Number, 
                required: true
            },
            isEditAdd: {
                type: Boolean,
                default: true,
            }
        },

        computed: {
            ...mapGetters(['allProductCategories']),
            id() {
                return this.product.id;
            },
            category() {
                if(this.product.products_category_id !== null) {
                    return _.find(this.allProductCategories, (o) => o.id === this.product.products_category_id);
                } else {
                    return {
                        name: 'No category'
                    }
                }
            }
        }
    }
</script>

<style lang="sass" scoped>
.product-card
    background-color: #fff
    box-shadow: 0px 6px 20px rgba(0,0,0,0.07)
    border-left: 4px solid #4E73DF
    padding: 1.4em 0.6em 1.1em 0.6em
    margin-bottom: 1em

    @media(max-width: 576px)
        padding: 1em

    .row>[class*=col-]
        margin-bottom: 0

    .voyager-trash
        cursor: pointer
        display: block
        margin-top: -3px
        font-size: 20px

        &:hover
            color: #FB4027

    @media(max-width: 576px)
        .row>[class*=col-]
            margin-bottom: 5px
        
        .row .col-sm-3
            maring-bottom: 0
</style>