<template>
    <div class="path">
        <ul class="path__nav">
            <li class="path__item path__item--done">
                <span class="path__item__text">Test</span>
            </li>
            <li class="path__item">
                <span class="path__item__text">Another test</span>
            </li>
            <li class="path__item">
                <span class="path__item__text">Last test</span>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'progressBar',

        computed: {
            ...mapGetters(['salesOrder'])
        }
    }
</script>

<style lang="sass" scoped>
$blue: #4E73DF
$green: #2ecc71

.path
    display: flex
    max-width: 100%
    overflow-x: scroll

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


</style>