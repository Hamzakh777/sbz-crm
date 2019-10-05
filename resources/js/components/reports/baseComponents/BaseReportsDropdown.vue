<template>
    <select
        @change="setTimeFrame"
        class="panel__select"
    >
        <option 
            v-for="(timeframe, index) in timeFrames"
            :value="timeframe" 
            :key="index"
            :selected="index === 0"
        >
            {{ trans.get(`reports.${timeframe}`) }}
        </option>
    </select>
</template>

<script>
    // this components is used to display different timeframes 

    export default {
        name: 'BaseReportsDropdown',

        props: {
            timeFrames: {
                type: Array,
                required: true
            }
        },

        data() {
            return {
                timeframe: this.timeFrames.length ? this.timeFrames[0] : null
            }
        },

        methods: {
            setTimeFrame(e) {
                this.timeframe = e.target.value;
                this.$emit('select-changed', e.target.value);
            },
        },

        created() {
            // we want to sync the selected value 
            // between this component and the parent
            // component
            this.$emit('select-changed', this.timeframe);   
        },
    }
</script>

<style lang="scss" scoped>

</style>