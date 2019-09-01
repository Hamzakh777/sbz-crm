<template>
    <div 
        class="card"
        :style="{ 'border-left-color': accentColor }"
    >
        <div 
            class="card__title"
            :style="{ 'color': accentColor }"
        >
            {{ trans.get(name) }}
        </div>
        <div class="card__value">
            <span>
                {{ value }}
            </span>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'CompensationValueCard',
        
        props: {
            /**
             * name is a laravel lang accessor
             */
            name: {
                type: String,
                // required: true
            },
            value: {
                type: Number,
                // required: true
            },
            accentColor: {
                type: String
            }
        }

    }
</script>

<style lang="sass" scoped>
.card
    background-color: #fff
    box-shadow: 0px 6px 20px rgba(0,0,0,0.07)
    border-left: 4px solid #4E73DF
    padding: 1em 1em 1em 1.5em
    margin-bottom: 1em
    height: 90px

    &__title
        margin-bottom: 2px
        font-weight: bold
        color: #4E73DF

    &__value 
        font-size: 20px
        font-weight: bold 
        color: #5a5c69
</style>