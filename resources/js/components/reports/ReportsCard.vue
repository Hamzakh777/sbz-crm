<template>
    <div 
        class="card"
        :style="'border-left-color:' + color"
    >
        <div class="card__title">
            {{ trans.get(title) }}
        </div>
        <div class="card__value">
            {{ value }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ReportsCard',

        props: {
            // laravel tanslation string key
            title: {
                type: String,
                required: true
            },
            // the border color
            color: {
                type: String,
                required: false,
                default: '#555'
            },
            value: {
                type: Number,
                required: true
            }
        }
    }
</script>

<style lang="sass" scoped>
.card 
    border: none
    border-left-width: 6px
    border-left-style: solid
    padding: 0.875em 1em
    box-shadow: 0px 2px 10px rgba(0,0,0,0.08)
    border-radius: 4px

    &__title 
        font-size: 14px
        margin-bottom: 2px

    &__value 
        font-size: 20px
        font-weight: bold 
        color: #555
</style>