<template>
    <BasePanel 
        icon="voyager-file-text"
        name="voyager.sales_orders.document"
        :showFooter="false"
    >
        <template 
            v-slot:body
        >
            <BaseLoader v-if="isLoading"></BaseLoader>
            <h4 class="title">{{ trans.get('voyager.sales_orders.select_tasks_collection') }}</h4>
                <addForm @addProduct="submit"></addForm>
            <div v-if="noDocuments" >
                <hr>
                <h4 class="title">{{ trans.get('voyager.sales_orders.select_tasks_collection') }}</h4>
                <div class="row list">
                    <documentCard
                        v-for="document in documents"
                        :key="document.id"
                        :document="document"
                        @remove="deleteDoc"
                        class="col-md-12"
                    >
                    </documentCard>
                </div>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import BasePanel from '../../../baseComponents/BasePanel';
    import BaseLoader from '../../../baseComponents/BaseLoader';
    import addForm from './addDocumentsFrom';
    import documentCard from './documentCard';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'documentPanel',

        components: {
            BasePanel,
            BaseLoader,
            addForm,
            documentCard
        },

        computed: {
            ...mapGetters(['salesOrder']),

            noDocuments() {
                if(this.documents.length === 0) {
                    return false;
                } else {
                    return true;
                }
            }
        },

        data() {
            return {
                isLoading: false,
                documents: []
            }
        },

        methods: {
            async submit(document) {
                document.salesOrderId = this.salesOrder.id;

                if(document.id !== null) { // update the document 
                    const response = await axios.put(`/api/documents/${document.id}`, document);

                } else { // store the document
                    const response = await axios.post('/api/documents/', document);

                    this.documents.push(response.data.document);
                }
            },

            async deleteDoc(id) {
                const response = await axios.delete(`/api/documents/${id}`);

                this.documents = this.documents.filter(doc => doc.id !== id);
            }
        },

        created() {
            // we want to show and hide the loader on every call 
            axios.interceptors.request.use(config => {
                this.isLoading = true
                return config
            }, error => {
                this.isLoading = false;
                return Promise.reject(error);
            })
            axios.interceptors.response.use(response => {
                this.isLoading = false
                return response
            }, error => {
                this.isLoading = false
                return Promise.reject(error)
            });
        },

        async mounted() {
            // load the data
            // we probably gonna send the data with the 
            // sales order
            // that way we only need on request
        },
    }
</script>

<style lang="sass" scoped>
.list 
    padding-top: 1em
</style>