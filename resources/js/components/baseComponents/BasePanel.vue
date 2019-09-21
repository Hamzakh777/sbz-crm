<template>
    <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i :class="icon"></i>{{ trans.get(this.name) }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <slot name="body"></slot>
        </div>
        <div class="panel-footer" v-if="showFooter">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'BasePanel',

        props: {
            icon: {
                type: String,
                required: false
            },
            name: {
                type: String,
                required: false
            },
            showFooter: {
                type: Boolean,
                required: false,
                default: false
            }
        }
    }
</script>

<style lang="sass" scoped>
.panel-body
    padding-top: 1.5em

.title 
    margin-bottom: 0.5em
    color: #555
</style>