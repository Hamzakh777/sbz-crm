<template>
    <div class="path">
        <ul class="path__nav">
            <li class="path__item">

            </li>
            <li class="path__item">

            </li>
            <li class="path__item">

            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'progressBar'
    }
</script>

<style lang="sass" scoped>
.path
    display: flex

    &__nav
        display: flex 
        flex-direction: row
        align-items: flex-start
        list-style: none

    &__item
        width: 200px
        height: 2.25em
        border: 3px solid #4E73DF
        position: relative

        &:after, &:before
            content: ''
            position: absolute
            right: -.575rem
            left: -.25rem

        &:after
            top: 0
            height: calc((2rem / 2) + .0625rem)
            transform: skew(28deg) translate3d(0,0,0)
            background-color: blue
            left: 1.125rem

        &:nth-child(1) 
            border-top-left-radius: 2rem
            border-bottom-left-radius: 2rem

</style>