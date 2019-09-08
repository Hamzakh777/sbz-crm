<template>
    <div>
        <ais-instant-search
            :search-client="searchClient"
            :stalled-search-delay="1000"
            index-name="sales_orders"
        >
            <!-- Other search components go here -->
            <ais-search-box 
                :show-loading-indicator="true"
                :placeholder="trans.get('voyager.generic.start_typing')">
            </ais-search-box>
            <ais-state-results>
                <ais-hits slot-scope="{ query }" v-if="query.length > 0">
                    <ul 
                        class="hits"
                        slot-scope="{ items }"
                    >
                        <li v-for="item in items" :key="item.objectID">
                            {{ item.owner_full_name }}
                        </li>
                    </ul>
                </ais-hits>
                <div v-else></div>
            </ais-state-results>
        </ais-instant-search>
    </div>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import { AisInstantSearch, AisSearchBox, AisHits, AisStateResults, AisConfigure } from 'vue-instantsearch';

    export default {
        name: 'SearchBar',

        components: {
            AisInstantSearch,
            AisStateResults,
            AisConfigure,
            AisSearchBox,
            AisHits
        },

        data() {
            return {
                searchClient: algoliasearch(
                    'LTUJ91APSO',
                    '453b545427930f6194b4701c5b537fd8'
                ),
                query: ''
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
.hits 
    background-color: #fff
    box-shadow: 0px -2px 28px rgba(52,64,85,0.16)
    list-style: none
    margin-top: 4px
    border-radius: 6px
    padding-left: 10px
</style>