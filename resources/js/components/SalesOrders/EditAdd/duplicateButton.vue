<template>
    <button
        class="btn btn-primary"
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
                            onClick : (e, toastObject) => {
                                // window.location.href = 
                                console.log('clicked')
                            }
                        },
                        icon: 'voyager-check'
                    })
                } catch (error) {
                    this.$toasted.error(this.trans.get('voyager.error.error_happened'), {
                        icon: 'voyager-warning'
                    })
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>