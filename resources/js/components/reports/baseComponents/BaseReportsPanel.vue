<template>
    <div 
        class="panel panel-primary panelbordered"
        :class="additionalClasses"
    >
        <div class="panel-body mt-2">
            <div class="panel__body__top">
                <h4 class="panel__title">
                    {{ trans.get(title) }}
                </h4>
                <div>
                    <slot name="headLeft"></slot>
                </div>
            </div>
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'BaseReportsPanel',

        props: {
            // this is laravel localisation string key
            title: {
                type: String,
                required: true
            },

            additionalClasses: {
                type: Array,
                required: false
            }
        }
    }
</script>

<style lang="sass" scoped>
.panel
    padding: 1.25em

    &--transparent
        background-color: transparent
        box-shadow: none

    &__body

        &__top 
            display: flex
            flex-direction: row
            justify-content: space-between
            width: 100%

    &__title 
        font-size: 14px
        font-weight: bold
        color: #555

    &__select 
        -webkit-appearance: none
        -moz-appearance: none
        background-position: right 50%
        background-repeat: no-repeat
        font-size: 14px
        margin-top: -6px
        background-image: url('data:image/svg+xml;utf8,<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1"><path d="M4 8L0 4h8z"/></svg>')
        padding-right: 1.5em
        font-weight: bold
        color: #555
        border-radius: 0
        background-color: transparent
        border-color: transparent

</style>