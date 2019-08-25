<template>
    <div class="document-card">
        <div class="row">
            <div class="col-md-4">
                {{document.name}}
            </div>
            <div class="col-md-4">
                {{ trans.get(`voyager.sales_orders.${document.type}`) }}
            </div>
            <div class="col-md-3">
                {{ trans.get(`voyager.generic.${document.status}`) }}  
            </div>
            <div class="col-md-1">
                <i 
                    class="voyager-trash"
                    @click="remove"
                ></i>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: 'documentCard',

        props: {
            document: {
                type: Object,
                required: true
            }
        },
    
        methods: {
            remove() {
                this.$emit('remove', this.document.id)
            }
        },
    }
</script>

<style lang="sass" scoped>
.document-card
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
        float: right

        &:hover
            color: #FB4027
</style>