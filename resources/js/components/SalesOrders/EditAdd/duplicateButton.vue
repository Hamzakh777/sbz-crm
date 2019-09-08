<template>
    <button
        class="btn btn-success"
        @click.prevent="click"
    >   
        <BaseLoader v-if="isLoading"></BaseLoader>
        {{ trans.get('voyager.generic.duplicate') }}
    </button>
</template>

<script>
    import BaseLoader from '../../baseComponents/BaseLoader';

    export default {
        name: 'duplicateButton',

        components: {
            BaseLoader
        },

        props: {
            salesOrderId: {
                type: Number,
                required: true
            }
        },

        data() {
            return {
                isLoading: false
            }
        },

        methods: {
            async click() {
                this.isLoading = true;
                try {
                    const response = await axios.get(`/api/sales-orders/${this.salesOrderId}/duplicate`);

                    this.$toasted.success(this.trans.get('voyager.success.duplicated_successfully'), {
                        action: {
                            text: this.trans.get('voyager.generic.open'),
                        },
                    })
                    this.isLoading = false;
                } catch (error) {
                    this.isLoading = false;
                    this.$toasted.error(this.trans.get('voyager.error.error_happened'), {
                    })
                }
            }
        },
    }
</script>

<style lang="sass" scoped>
.btn 
    position: relative
</style>