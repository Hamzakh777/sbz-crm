<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="sales_orders"
    >
        <!-- Other search components go here -->
        <ais-search-box placeholder="Search contacts..."></ais-search-box>
        <ais-hits>

        </ais-hits>
    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';

    export default {
        name: 'SearchBar',

        data() {
            return {
                searchClient: algoliasearch(
                    'LTUJ91APSO',
                    '453b545427930f6194b4701c5b537fd8'
                ),
            };
        },
    }
</script>

<style lang="sass" scoped>
.searchh
    background-color: #FAFAFC
    border-radius: 6px
    max-width: 500px
    display: flex
    flex-direction: row
    justify-content: space-between
    padding: 4px 6px
    margin-top: 11px
    margin-left: 25px
    // box-shadow: 0px 2px 5px rgba(0,0,0,0.06)
    // border: 1px solid rgba(0,0,0,0.07)

    &__input 
        border-color: transparent
        background-color: transparent
        flex-grow: 1
        margin-left: 8px

    &__icon 
        font-size: 20px
        display: block
        margin-bottom: -6px 
        margin-left: 6px

</style>