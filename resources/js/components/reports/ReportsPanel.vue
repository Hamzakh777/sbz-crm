<template>
    <div class="panel panel-primary panelbordered">
        <BaseLoader v-if="isLoading"></BaseLoader>
        <div class="panel-body">
            <div class="panel__body__top">
                <h4 class="panel__title">
                    {{ trans.get(title) }}
                </h4>
                <select
                    @change="setTimeFrame"
                    class="panel__select"
                >
                    <option 
                        v-for="(timeFrame, index) in timeFrames"
                        :value="timeFrame" 
                        :key="index"
                        :selected="index === 0"
                    >
                        {{ trans.get(`reports.${timeFrame}`) }}
                    </option>
                </select>
            </div>
            <ReportsBarChart>
                
            </ReportsBarChart>
        </div>
    </div>
</template>

<script>
    import ReportsBarChart from './ReportsBarChart';
    import BaseLoader from '../baseComponents/BaseLoader';

    // I want to be using the same reports panel multiple times to 
    // generate different chart for different types of data
    // Thus, I need a prop
    export default {
        name: 'ReportsPanel',

        props: {
            timeFrames: {
                type: Array,
                required: true
            },
            title: {
                type: String,
                required: true
            }
        },

        components: {
            ReportsBarChart,
            BaseLoader
        },

        data() {
            return {
                timeFrame: this.timeFrames.length ? this.timeFrames[0].id : null,
                isLoading: false,
            }
        },

        methods: {
            setTimeFrame(e) {
                console.log(e.target.value);
                // this.timeFrame = 
            },

            async fetchData() {
                this.isLoading = true;
                try {
                    const response = await axios.get();

                } catch(error) {
                    console.error(error);
                }
            }
        },
    }
</script>

<style lang="sass" scoped>
.panel
    padding: 1.25em

    &__body

        &__top 
            display: flex
            flex-direction: row
            justify-content: space-between
            width: 100%
            maring-bottom: 0.625em

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