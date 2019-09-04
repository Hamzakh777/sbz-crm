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
            <div class="wrapper">
                <range-slider
                    class="slider"
                    v-if="isSlider"
                    min="0"
                    max="100"
                    step="1"
                    v-model="compensation[propertyName]">
                </range-slider>
                <input 
                    type="number" 
                    v-model="compensation[propertyName]" 
                    class="card__value__input form-control" 
                    :class="{'card__value__input--small': isSlider}"
                    oninput="validity.valid||(value='');"
                >
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import RangeSlider from 'vue-range-slider';

    export default {
        name: 'CompensationValueCard',

        components: {
            RangeSlider
        },
        
        props: {
            name: {
                type: String,
                // required: true
            },
            propertyName: {
                type: String,
                // required: true
            },
            accentColor: {
                type: String
            },
            isSlider: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            ...mapGetters('compensations', ['compensation'])
        },
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

        &__input 
            font-size: 20px
            font-weight: bold 
            color: #5a5c69
            padding-left: 0

            &::-webkit-inner-spin-button, &::-webkit-outer-spin-button 
                -webkit-appearance: none
                margin: 0

            &:focus  
                border-bottom-color: #2ecc71 !important

            &--small
                width: 42px
                padding-right: 0
                margin-top: -6px

    .slider 
        width: 100%
        padding-right: 30px
        padding-left: 0

    .wrapper 
        display: flex
        flex-direction: row
        justify-content: space-between
</style>