<template>
    <button
        class="btn btn-success btn-save pull-right"
        @click="clicked"
    >
        <i class="voyager-check-circle"></i>
        <span>{{ trans.get('voyager.generic.save') }}</span>
    </button>
</template>

<script>
    export default {
        name: 'save',

        methods: {
            clicked() {
                this.$emit('click');
            }
        }
    }
</script>

<style lang="sass" scoped>
.btn
    margin-top: 2px 
    
    i 
        position: relative
        top: 2px
</style>