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
                this.showLoader();
                if(document.id !== null) { // update the document 
                    const response = await axios.put(`/api/documents/${document.id}`, document);
                    this.hideLoader();

                } else { // store the document
                    const response = await axios.post('/api/documents/', document);
                    this.hideLoader();
                    
                    this.documents.push(response.data.document);
                }
            },

            async deleteDoc(id) {
                this.showLoader();
                const response = await axios.delete(`/api/documents/${id}`);
                this.hideLoader();

                this.documents = this.documents.filter(doc => doc.id !== id);
            },

            hideLoader() {
                this.isLoading = false;
            },
            showLoader() {
                this.isLoading = true;
            }
        },

        async mounted() {
            this.documents = this.salesOrder.documents;
        },
    }
</script>

<style lang="sass" scoped>
.list 
    padding-top: 1em
</style>