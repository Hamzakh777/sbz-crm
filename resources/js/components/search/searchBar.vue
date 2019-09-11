<template>
    <div>
        <ais-instant-search
            :search-client="searchClient"
            :stalled-search-delay="1000"
            :index-name="selectedIndex"
        >
            <!-- Other search components go here -->
            <div class="search-wrapper">
                <ais-search-box 
                    :show-loading-indicator="true"
                    :placeholder="trans.get('voyager.generic.start_typing')">
                </ais-search-box>
                <select 
                    class="search-wrapper__dropdown"
                    v-model="selectedIndex"
                >
                    <option value="sales_orders">{{ trans.get('voyager.generic.sales_orders') }}</option>
                    <option value="users">{{ trans.get('voyager.generic.users') }}</option>
                    <option value="documents">{{ trans.get('voyager.generic.documents') }}</option>
                    <option value="tasks_collections">{{ trans.get('voyager.generic.tasks_collections') }}</option>
                </select>
            </div>
            <ais-state-results>
                <ais-hits slot-scope="{ query }" v-if="query.length > 0">
                    <ul 
                        class="hits"
                        slot-scope="{ items }"
                    >
                        <li class="hit" v-for="item in items" :key="item.objectID">
                            <a :href="'/sales-orders/' + item.id + '/edit'" v-if="selectedIndex === 'sales_orders'">
                                Id: {{ item.id }} - 
                                <ais-highlight attribute="owner_full_name" :hit="item" />
                            </a>
                            <a :href="'/documents/' + item.id + '/edit'" v-else-if="selectedIndex === 'documents'">
                                Id: {{ item.id }} - 
                                <ais-highlight attribute="name" :hit="item" />
                            </a>
                            <a :href="'/tasks-collections/' + item.id + '/edit'" v-else-if="selectedIndex === 'tasks_collections'">
                                Id: {{ item.id }} - 
                                <ais-highlight attribute="name" :hit="item" />
                            </a>
                            <a :href="'/users/' + item.id + '/edit'" v-else-if="selectedIndex === 'users'">
                                Id: {{ item.id }} - 
                                Name: <ais-highlight attribute="username" :hit="item" />
                            </a>
                        </li>
                    </ul>
                </ais-hits>
                <!-- remove the default view -->
                <div v-else></div>
            </ais-state-results>
        </ais-instant-search>
    </div>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import { AisInstantSearch, AisSearchBox, AisHits, AisStateResults, AisHighlight } from 'vue-instantsearch';

    export default {
        name: 'SearchBar',

        components: {
            AisInstantSearch,
            AisStateResults,
            AisSearchBox,
            AisHighlight,
            AisHits
        },

        data() {
            return {
                searchClient: algoliasearch(
                    'LTUJ91APSO',
                    '453b545427930f6194b4701c5b537fd8'
                ),
                query: '',
                selectedIndex: 'sales_orders',
            };
        },
    }
</script>

<style lang="sass" scoped>
.search-wrapper
    display: flex
    flex-direction: row
    justify-content: flex-start
    max-width: 400px
    width: 100%

    &__dropdown 
        -webkit-appearance: none
        -moz-appearance: none
        background-position: right 50%
        background-repeat: no-repeat
        background-image: url('data:image/svg+xml;utf8,<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1"><path d="M4 8L0 4h8z"/></svg>')
        padding-left: .7em
        border-top-left-radius: 0
        border-bottom-left-radius: 0
        height: 32px
        font-size: 13px
        background-color: #fff
        border: 1px solid #c4c8d8
        border-left: 0 
        width: 130px

.hits 
    background-color: #fff
    box-shadow: 0px -2px 28px rgba(52,64,85,0.16)
    list-style: none
    margin-top: 4px
    border-radius: 6px
    padding: 10px
    max-width: 270px

    .hit 
        padding: 6px
</style>