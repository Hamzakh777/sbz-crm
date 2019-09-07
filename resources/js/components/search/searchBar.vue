<template>
    <ais-instant-search
        :search-client="searchClient"
        :stalled-search-delay="1000"
        index-name="sales_orders"
    >
        <!-- Other search components go here -->
        <ais-search-box 
            :show-loading-indicator="true"
            :placeholder="trans.get('voyager.generic.start_typing')">
            <div slot="submit-icon ais-SearchBox-submit">
                <i class="voyager-search"></i>
            </div>
            <div slot-scope="{ currentRefinement, isSearchStalled, refine }">
                <form role="search" class="ais-SearchBox-form">
                    <input 
                        type="search" 
                        @input="refine($event.currentTarget.value)"
                        v-model="searchValue"
                        class="ais-SearchBox-input">
                    
                </form>
            </div>
        </ais-search-box>
        <ais-hits v-if="searchValue !== '' && searchValue !== null">
            <ul 
                class="hits"
                slot-scope="{ items }">
                <li v-for="item in items" :key="item.objectID">
                {{ item.owner_full_name }}
                </li>
            </ul>
        </ais-hits>
    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import { AisInstantSearch, AisSearchBox, AisHits } from 'vue-instantsearch';

    export default {
        name: 'SearchBar',

        components: {
            AisInstantSearch,
            AisSearchBox,
            AisHits
        },

        data() {
            return {
                searchClient: algoliasearch(
                    'LTUJ91APSO',
                    '453b545427930f6194b4701c5b537fd8'
                ),
                searchValue: null,
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
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1)
    list-style: none
    
</style>