<template>
    <div class="document-card">
        <div class="row">
            <div class="col-md-4">
                {{trans.get('voyager.generic.name')}}: <b>{{document.name}}</b>
            </div>
            <div class="col-md-4">
                {{ trans.get('voyager.generic.type') }}: <b>{{ trans.get(`voyager.sales_orders.${document.type}`) }}</b>
            </div>
            <div class="col-md-3">
                {{ trans.get('voyager.generic.status') }}: <b>{{ trans.get(`voyager.generic.${document.status}`) }}  </b>
            </div>
            <div class="col-md-1">
                <i 
                    class="voyager-trash"
                    @click="remove"
                ></i>
                <a :href="'/api/file-download?path=' + document.path" v-if="document.path !== null" target="_blank">
                    <i class="voyager-double-down"
                    >
                    </i>
                </a>
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
                this.$emit('remove', this.document.id);
            },
            download() {
                this.$emit('download', this.document.path);
            }
        },
    }
</script>

<style lang="sass" scoped>
.document-card
    background-color: #fff
    box-shadow: 0px 6px 20px rgba(0,0,0,0.07)
    border-left: 4px solid #4E73DF
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

    .voyager-double-down 
        cursor: pointer
        display: block
        margin-top: -5px
        font-size: 24px
        float: right
        margin-right: 12px

        &:hover
            color: #2ecc71

    @media(max-width: 576px)
        padding: 1em 0.8em 0.5em !important

        .row>[class*=col-]
            margin-bottom: 5px
        
        .row .col-sm-3, .row .col-md-1
            maring-bottom: 0
</style>
