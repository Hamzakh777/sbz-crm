<template>
    <table class="vtable">
        <thead class="thead">
            <slot name="thead"></slot>
        </thead>
        <tbody class="tbody">
            <slot name="tbody"></slot>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'BaseReportsTable',
    }
</script>

<style lang="sass" scoped>
.vtable 
    width: 100% 
    margin-top: 0.75em

    .tbody

        tr

            td 
                padding: 1em 0
                border-top: 1px solid #B5B9C1

            &:nth-child(1)
                td
                    border-top: none
</style>