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
            <h4 class="title">{{ trans.get('voyager.sales_orders.document_details') }}</h4>
                <addForm @storeDocument="storeDocument"></addForm>
            <div v-if="noDocuments" >
                <hr>
                <h4 class="title">{{ trans.get('voyager.sales_orders.saved_documents') }}</h4>
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

        watch: {
            // we recieve the documents in ajax with 
            // the sales order
            'salesOrder.documents': function(newVal, oldVal) {
                this.documents = newVal;
            }
        },

        computed: {
            ...mapGetters(['salesOrder']),

            noDocuments() {
                if(this.documents.length === 0) {
                    return false;
                } else {
                    return true;
                }
            },

        },

        data() {
            return {
                isLoading: false,
                documents: []
            }
        },

        methods: {
            async submit(document) {
                
                if(document.id !== null) { // update the document 
                    const response = await axios.put(`/api/documents/${document.id}`, document);
                    this.hideLoader();

                } else { // store the document
                    
                }
            },

            async storeDocument(document) {
                this.showLoader();
                 try {
                    const response = await axios.post(
                        '/api/documents/', 
                        document, {
                            headers: { 'content-type': 'multipart/form-data' }
                        });

                    this.hideLoader();
                    this.documents.push(response.data.document);
                } catch(e) {
                    console.log(e);
                }
            },

            async deleteDoc(id) {
                this.showLoader();
                try {
                    const response = await axios.delete(`/api/documents/${id}`);
                    this.hideLoader();
    
                    this.documents = this.documents.filter(doc => doc.id !== id);
                } catch (error) {
                    this.hideLoader();
                    console.log(error);
                    this.$toasted.error(this.trans.get('voyager.error.error_happened'));
                }
            },


            hideLoader() {
                this.isLoading = false;
            },
            showLoader() {
                this.isLoading = true;
            }
        },
    }
</script>

<style lang="sass" scoped>
hr
    margin-bottom: 1.6em

.list 
    padding-top: 1em
    padding-left: 15px
    padding-right: 15px
</style>