<template>
    <div>
         <pagination 
            :data="data" 
            @pagination-change-page="changePaginationPage"
            :limit="4"
        ></pagination>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import Pagination from "laravel-vue-pagination";

    export default {
        name: 'SalesOrdersPaginator',

        props: {
            initialPaginationData: {
                type: Object
            }
        },

        components: {
            Pagination
        },

        computed: {
            ...mapGetters(['allSalesOrders']),

            data() {
                if(this.isEmpty(this.allSalesOrders)) {
                    return this.initialPaginationData;
                } else {
                    return this.allSalesOrders;
                }
            }
        },

         methods: {
        ...mapActions(['changePaginationPage']),

        /**
         * Check if an object is empty
         */
        isEmpty(obj) {
          for(var key in obj) {
              if(obj.hasOwnProperty(key))
                  return false;
          }
          return true;
      }
    },

    }
</script>

<style lang="scss" scoped>

</style>