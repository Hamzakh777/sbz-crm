<template>
    <button 
        class="btn btn-sm btn-primary pull-right"
        @click.prevent="clicked"
    >
        <i :class="iconName"></i> 
        <span>{{ btnName }}</span>
    </button>
</template>

<script>
export default {
    name: 'BaseButton',

    props: {
        btnName: {
            type: String,
            required: true
        },
        iconName: {
            type: String,
            required: true
        },
        data: {
            required: false
        }
    },

    methods: {
        clicked() {
            this.$emit('clicked', this.data);
        }
    }
}
</script>

<style>

</style>
