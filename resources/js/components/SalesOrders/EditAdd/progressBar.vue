<template>
    <div class="path">
        <ul class="path__nav">
            <li class="path__item path__item--done">
                <span class="path__item__text">test</span>
            </li>
            <li class="path__item">

            </li>
            <li class="path__item">

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

.path
    display: flex

    &__nav
        display: flex 
        flex-direction: row
        align-items: flex-start
        list-style: none
        background-color: #fff
        padding: 0.825em
        box-shadow: 0px 2px 12px rgba(0,0,0,0.07)

    &__item
        width: 200px
        height: 2em
        margin-right: 0.125rem
        border-right-color: transparent
        position: relative

        &:after, &:before
            content: ''
            position: absolute
            right: -.575rem
            left: -.25rem
            background-color: #fff
            background-image: linear-gradient(90deg,$blue,$blue .125rem, transparent .125rem),linear-gradient(90deg,$blue,$blue .125rem,transparent .125rem),linear-gradient($blue,$blue .125rem,transparent .125rem)
            background-repeat: no-repeat
            background-size: .2rem 100%,.2rem 100%,100% .2rem

        &:before
            top: 0
            height: 1rem
            transform: skew(30deg) translate3d(0,0,0)
            left: 1.125rem
            background-position: top right,top left,top left
            
        &:after 
            bottom: 0
            height: 1rem
            transform: skew(-30deg) translate3d(0,0,0)
            left: 1.125rem
            background-position: top right,top left,bottom left

        &:nth-child(1) 
            border-top-left-radius: 2rem
            border-bottom-left-radius: 2rem

            &:before, &:after
                left: 1.25rem

        &__text     
            text-align: center
            color: #fff
            position: absolute
            top: 50%
            left: 50%
            transform: translate(-50%,-50%)
            font-weight: 500
            z-index: 5 

        &--done 
            background-color: $blue

            &:before, &:after
                background-color: $blue


</style>