<template>
    <div class="path">
        <ul class="path__nav">
            <li 
                class="path__item"
                v-for="(status, index) in statusWithState"
                :key="index"
                :class="{'path__item--done': status.done}"
            >
                <span class="path__item__text">
                    {{ trans.get('voyager.sales_orders.' + status.name) }}
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'progressBar',

        computed: {
            ...mapGetters(['salesOrder']),

            statusWithState() {
                let pastDone = false;
                let result = [];

                this.status.forEach(status => {
                    let obj = {};
                    obj.name = status;
                    if(status === this.salesOrder.salesOrderStatus ) {
                        obj.done = true;
                        pastDone = true;
                    }  else if(pastDone === true) {
                        obj.done = false;
                    } else if(this.salesOrder.salesOrderStatus !== null) {
                        obj.done = true;
                    } else {
                        obj.done = false;
                    }
                    result.push(obj);
                })

                return result;
            }
        },

        data() {
            return {
                status: ['entry', 'processing', 'closing']
            }
        },
    }
</script>

<style lang="sass" scoped>
$blue: #4E73DF
$green: #2ecc71

.path
    display: flex
    width: fit-content
    max-width: 100%
    overflow-x: scroll
    box-shadow: 0px 2px 6px rgba(0,0,0,0.08)

    &__nav
        display: flex 
        flex-direction: row
        align-items: flex-start
        list-style: none
        padding: 0.825em
        margin-bottom: 0

    &__item
        width: 200px
        height: 2em
        margin-right: 0.125rem
        border-right-color: transparent
        position: relative
        cursor: pointer
        margin-right: 1.25em

        &:after, &:before
            content: ''
            position: absolute
            right: -.575rem
            left: -.5rem
            background-color: $blue

        &:before
            top: 0
            height: 1rem
            transform: skew(30deg) translate3d(0,0,0)
            left: -0.25rem
            
        &:after 
            bottom: 0
            height: 1rem
            transform: skew(-30deg) translate3d(0,0,0)
            left: -0.25rem

        &:nth-child(1) 
            border-top-left-radius: 2rem
            border-bottom-left-radius: 2rem
            background-color: $blue

            &:before, &:after
                left: 1.25rem

        &:last-child
            background-color: $blue
            border-top-right-radius: 2rem
            border-bottom-right-radius: 2rem
            margin-right: 0

            &:after, &:before
                right: 1rem

        &__text     
            text-align: center
            color: #fff
            position: absolute
            top: 50%
            left: 50%
            transform: translate(-50%,-50%) 
            font-weight: 500
            font-size: 13px
            z-index: 5 
            transition: all 0.2s ease-in

        &--done 
            background-color: $green

            &:before, &:after
                background-color: $green

            &:nth-child(1), &:last-child
                background-color: $green

    @media(max-width: 1130px)
        margin-left: 15px
        margin-top: 10px 
        margin-bottom: 25px
        margin-right: 15px

    @media(max-width: 500px)
        margin-left: 0
</style>